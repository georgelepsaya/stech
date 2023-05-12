<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use App\Models\ProductPage;
use App\Models\Tag;
use App\Models\TopicPage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        if ($page_type == 'all' || !$page_type) {
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
        $companies = CompanyPage::orderBy('name', 'asc')->get();
        return view('pages.create_product', compact('companies'));
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
    public function storeCompany(Request $request) {
        // validate the input
        $request->validate([
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ], [
            'company_logo.image' => 'The company logo must be an image',
            'company_logo.mimes' => 'The company logo must be a jpeg, png, jpg, or svg file',
            'company_logo.max' => 'The company logo must be no larger than 2MB'
        ]);

        // after passing validation

        $imageName = time() . '.' . $request->company_logo->extension();
        $image = Image::make($request->file('company_logo'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(storage_path('app/public/images/' . $imageName));

        // create a new company page and save all data
        $companyPage = new CompanyPage();
        $companyPage->name = $request->name;
        $companyPage->description = $request->description;
        $companyPage->logo_path = 'images/' . $imageName;
        $companyPage->website = $request->website;
        $companyPage->industry = $request->industry;
        $companyPage->content = $request->content;
        $companyPage->founding_date = $request->founding_date;
        $companyPage->save();

        return redirect()->route('pages.index')->with('success', 'Company page created successfully.');
    }

    // Store the product in the database
    public function storeProduct(Request $request) {
//        dd($request->toArray());
        // validate the input
        $request->validate([
            'product_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ], [
            'product_logo.image' => 'The company logo must be an image',
            'product_logo.mimes' => 'The company logo must be a jpeg, png, jpg, or svg file',
            'product_logo.max' => 'The company logo must be no larger than 2MB'
        ]);

        // after passing validation

        $imageName = time() . '.' . $request->product_logo->extension();
        $image = Image::make($request->file('product_logo'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(storage_path('app/public/images/' . $imageName));

        // create a new company page and save all data
        $productPage = new ProductPage();
        $productPage->name = $request->name;
        $productPage->description = $request->description;
        $productPage->logo_path = 'images/' . $imageName;
        $productPage->company_id = $request->company_id;
        $productPage->content = $request->content;
        $productPage->release_date = $request->release_date;
        $productPage->save();

        return redirect()->route('pages.index')->with('success', 'Company page created successfully.');
    }

    // Show the form for editing the specified page
    public function edit() {

    }

    // Update the specified page in storage
    public function update() {

    }

    // Remove the specified page from storage

}
