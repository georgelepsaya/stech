<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use App\Models\ProductPage;
use App\Models\Tag;
use App\Models\TopicPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Display listings of all company pages
    public function index(Request $request) {

        // get the page type from request
        $page_type = $request->input('page_type');

        // get the search from request
        $search = $request->input('search');

        // initialise pages variable to store retrieved pages data
        $pages = [];

        if ($page_type == 'all') {
            // declare queries
            $companyPagesQuery = CompanyPage::query();
            $productPagesQuery = ProductPage::query();
            $topicPagesQuery = TopicPage::query();

            // if there is a search - find matching pages
            if ($search) {
                $companyPagesQuery->where('name', 'LIKE', "%{$search}%");
                $productPagesQuery->where('name', 'LIKE', "%{$search}%");
                $topicPagesQuery->where('name', 'LIKE', "%{$search}%");
            }

            $pages = $companyPagesQuery->get()->concat($productPagesQuery->get())->concat($topicPagesQuery->get());

        } elseif ($page_type == 'company') {
            $companyPagesQuery = CompanyPage::query();
            if ($search) {
                $companyPagesQuery->where('name', 'LIKE', "%{$search}%");
            }
            $pages = $companyPagesQuery->get();

        } elseif ($page_type == 'product') {
            $productPagesQuery = ProductPage::query();
            if ($search) {
                $productPagesQuery->where('name', 'LIKE', "%{$search}%");
            }
            $pages = $productPagesQuery->get();

        } elseif ($page_type == 'topic') {
            $topicPagesQuery = TopicPage::query();
            if ($search) {
                $topicPagesQuery->where('name', 'LIKE', "%{$search}%");
            }
            $pages = $topicPagesQuery->get();
        }

        // retrieve all tags for filtering
        $tags = Tag::all();

        return view('pages.index', compact('pages', 'tags'));
    }

    // Show the form for creating a new page
    public function createCompany() {
        return view('pages.create_company');
    }

    public function createProduct() {
        return view('pages.create_product');
    }

    public function createTopic() {
        return view('pages.create_topic');
    }

    // Display the specified company page
    public function showCompany($id) {
        $companyPage = CompanyPage::findOrFail($id);
        return view('pages.show_company', ['companyPage' => $companyPage]);
    }

    // Display the specified product page
    public function showProduct($id) {
        $productPage = ProductPage::findOrFail($id);
        return view('pages.show_product', ['productPage' => $productPage]);
    }

    // Display the specified topic page
    public function showTopic($id) {
        $topicPage = TopicPage::findOrFail($id);
        return view('pages.show_topic', ['topicPage' => $topicPage]);
    }

    // Store a newly created page in storage
    public function store() {

    }

    // Show the form for editing the specified page
    public function edit() {

    }

    // Update the specified page in storage
    public function update() {

    }

    // Remove the specified page from storage

}
