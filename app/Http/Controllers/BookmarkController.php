<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyPage;
use App\Models\ProductPage;
use App\Models\TopicPage;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    # utilities #
    
    // compare target names with the search (works only for specific type)
    private function filterBookmarks($type, $tableName, $field, &$search) {
        
        // get bookmarks of one type
        $query = Bookmark::where('target_type','=',$type);
        
        // compare target names with the search
        $query->where(
            // find the corresponding target name
            function(Builder $query) use($tableName, $field) {
                $query->select($field)->from($tableName)->whereColumn($tableName.'.id','target_id')->limit(1);
            },
            // compare with search
            'LIKE',"%{$search}%"
        );
        return $query->get();
    }
    
    # public functions #

    public function index(Request $request) {
        // Prerequisites
        $bookmarks = [];
        $tags = []; // I will break my table
        $filterTags = [];
        $target_type = $request->input('target_type');
        $search = $request->input('search');

        if ($target_type == 'all' || !$target_type) {
            $bookmarks = $this->filterBookmarks(1, 'company_page', 'name', $search)->
            concat($this->filterBookmarks(2, 'product_page', 'name', $search))->
            concat($this->filterBookmarks(3, 'topic_page', 'name', $search))->
            concat($this->filterBookmarks(4, 'articles', 'title', $search));

        } elseif ($target_type == 'company') {
            $bookmarks = $this->filterBookmarks(1, 'company_page', 'name', $search);

        } elseif ($target_type == 'product') {
            $bookmarks = $this->filterBookmarks(2, 'product_page', 'name', $search);

        } elseif ($target_type == 'topic') {
            $bookmarks = $this->filterBookmarks(3, 'topic_page', 'name', $search);

        } elseif ($target_type == 'article') {
            $bookmarks = $this->filterBookmarks(4, 'articles', 'title', $search);
        }

        return view('bookmarks.index', compact('bookmarks', 'tags', 'filterTags'));
    }
    
    public function store(Request $request) {
        $validator = validator::make($request->all(), [
            'target_type' => ['required', 'numeric', Rule::in([1, 2, 3, 4])],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'target_id' => ['required', 'numeric'] // exists is implemented later
        ])->stopOnFirstFailure();
        
        // I made new static function 'isUnique' because the primary key is composite
        $requestPasses = !$validator->fails() && Bookmark::isUnique($request); // not final result
        $redirect = null; // used for conditional redirect

        
        // wanna be 'exists:page'
        switch($request->target_type) {
            case 1 :
                $pageNotFound = CompanyPage::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_company', ['id' => $request->target_id]);
                }
                break;
            case 2 :
                $pageNotFound = ProductPage::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_product', ['id' => $request->target_id]);
                }
                break;
            case 3 :
                $pageNotFound = TopicPage::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_topic', ['id' => $request->target_id]);
                }
                break;
            case 4 :
                $pageNotFound = Article::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('feed.show_article', ['id' => $request->target_id]);
                }
                break;
        }

        // if there is a problem with target send to 'pages.index' or 'feed.index'
        if($redirect == null) {
            if($request->target_type != 4) {
                $redirect = redirect('pages/');
            } else {
                $redirect = redirect('feed/');
            }
        }
        // actual bookmark creation
        if($requestPasses) {
            Bookmark::create(['user_id' => $request->user_id, 'target_id' => $request->target_id, 'target_type' => $request->target_type]);
        }

        return $redirect;
    }

    public function destroy(Request $request) {
        
        $validator = validator::make($request->all(), [
            'target_type' => ['required', 'numeric', Rule::in([1, 2, 3, 4])],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'target_id' => ['required', 'numeric'] // exists is implemented later
        ])->stopOnFirstFailure();
        
        // I made new static function 'isUnique' because the primary key is composite
        $requestPasses = !$validator->fails() && !Bookmark::isUnique($request); // not final result
        $redirect = null; // used for conditional redirect

        
        // wanna be 'exists:page'
        switch($request->target_type) {
            case 1 :
                $pageNotFound = CompanyPage::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_company', ['id' => $request->target_id]);
                }
                break;
            case 2 :
                $pageNotFound = ProductPage::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_product', ['id' => $request->target_id]);
                }
                break;
            case 3 :
                $pageNotFound = TopicPage::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('pages.show_topic', ['id' => $request->target_id]);
                }
                break;
            case 4 :
                $pageNotFound = Article::where('id', '=', $request->target_id)->get()->isEmpty();
                if($pageNotFound) {
                    $requestPasses = 0;
                } else {
                    $redirect = redirect()->route('feed.show_article', ['id' => $request->target_id]);
                }
                break;
        }

        // if there is a problem with target send to 'pages.index' or 'feed.index'
        if($redirect == null) {
            if($request->target_type != 4) {
                $redirect = redirect('pages/');
            } else {
                $redirect = redirect('feed/');
            }
        }
        
        // actual bookmark deletion
        if($requestPasses) {
            Bookmark::findByCompositePK($request)->delete();
        }

        return $redirect;
    }
}
