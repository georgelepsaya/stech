<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use Illuminate\Http\Request;

class CompanyPageController extends Controller
{
    // Display listings of all company pages
    public function index() {
        $pages = CompanyPage::all();
        return view('company_pages', compact('pages'));
    }
}
