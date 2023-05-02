<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Display listings of all company pages
    public function index() {
        $pages = CompanyPage::all();
        return view('pages', compact('pages'));
    }

    // Display the specified page
    public function show($id) {
        $page = CompanyPage::findOrFail($id);
        return view('company_page', ['page' => $page]);
    }
}
