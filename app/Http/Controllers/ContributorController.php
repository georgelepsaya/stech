<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contributor;
use App\Models\CompanyPage;
use App\Models\ProductPage;
use App\Models\TopicPage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class ContributorController extends Controller
{
    // I'm so sorry for this
    public function store(Request $request) {
        $validator = validator::make($request->all(), [
            'page_type' => ['required', 'numeric', Rule::in([1, 2, 3])],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'page_id' => ['required', 'numeric'] // exists is implemented later
        ])->stopOnFirstFailure();

        // I made new static function 'isUnique' because the primary key is composite
        $requestPasses = !$validator->fails() && Contributor::isUnique($request); // not final result
        $redirect = null; // used for conditional redirect
        
        // wanna be 'exists:page'
        switch($request->page_type) {
            case 1 :
                $pageNotFound = CompanyPage::where('id', '=', $request->page_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_company', ['id' => $request->page_id]);
                }
                break;
            case 2 :
                $pageNotFound = ProductPage::where('id', '=', $request->page_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_product', ['id' => $request->page_id]);
                }
                break;
            case 3 :
                $pageNotFound = TopicPage::where('id', '=', $request->page_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_topic', ['id' => $request->page_id]);
                }
                break;
        }
        
        // if there is a problem with page send to pages.index
        if($redirect == null) {
            $redirect = redirect('pages/');
        }
        // actual contributor creation
        if($requestPasses) {
            Contributor::create(['user_id' => $request->user_id, 'page_id' => $request->page_id, 'page_type' => $request->page_type]);
        }

        return $redirect;
    }

    public function pendingIndex() {
        $contributors = Contributor::where('approved','==',0)->get();
        return view('requests.contributors', compact('contributors'));
    }

    public function approveContribution(Request $request) {
        $request->validate([
            'id' => 'required|exists:contributors'
        ]);
        $contributor = Contributor::findOrFail($request->id);
        $contributor->approved = 1;
        $contributor->save();
        return redirect('admin/contributors');
    }
}
