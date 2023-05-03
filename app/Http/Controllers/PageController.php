<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use App\Models\Tag;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Display listings of all company pages
    public function index(Request $request) {
        // retrieve all tags for filtering
        $tags = Tag::all();

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

        return view('pages.index', compact('pages', 'tags'));
    }

    // Display the specified page
    public function show($id) {
        $page = CompanyPage::findOrFail($id);
        return view('pages.show', ['page' => $page]);
    }
}
