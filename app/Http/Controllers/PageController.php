<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Display listings of all company pages
    public function index(Request $request) {
        // get the search request
        $search = $request->input('search');

        // get all pages
        $pagesQuery = CompanyPage::query();

        // if search is present -> filter pages
        if ($search) {
            $pagesQuery->where('name', 'LIKE', "{$search}%");
        }

        // get the filtered data by the query
        $pages = $pagesQuery->get();

        return view('pages', compact('pages'));
    }

    // Display the specified page
    public function show($id) {
        $page = CompanyPage::findOrFail($id);
        return view('company_page', ['page' => $page]);
    }
}
