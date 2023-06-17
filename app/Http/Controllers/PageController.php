<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use App\Models\ProductPage;
use App\Models\Tag;
use App\Models\TopicPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $custom_logo = !is_null($request->company_logo);
        if($custom_logo) {
            $imageName = time() . '.' . $request->company_logo->extension();
            $image = Image::make($request->file('company_logo'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
            $image->save(storage_path('app/public/images/' . $imageName));
        }

        // create a new company page and save all data
        $companyPage = new CompanyPage();
        $companyPage->name = $request->name;
        $companyPage->description = $request->description;
        $companyPage->logo_path = (($custom_logo)? 'images/' . $imageName : null);
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
        $custom_logo = !is_null($request->product_logo);
        if($custom_logo) {
            $imageName = time() . '.' . $request->product_logo->extension();
            $image = Image::make($request->file('product_logo'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
            $image->save(storage_path('app/public/images/' . $imageName));
        }
        // create a new company page and save all data
        $productPage = new ProductPage();
        $productPage->name = $request->name;
        $productPage->description = $request->description;
        $productPage->logo_path = (($custom_logo)? 'images/' . $imageName : null);
        $productPage->company_id = $request->company_id;
        $productPage->content = $request->content;
        $productPage->release_date = $request->release_date;
        $productPage->save();

        return redirect()->route('pages.index')->with('success', 'Company page created successfully.');
    }

    // Show the form for editing the specified page
    public function editCompany($id) {
        $companyPage = CompanyPage::findOrFail($id);
        return view('pages.edit_company', compact('companyPage'));
    }
    public function editProduct($id) {
        $productPage = ProductPage::findOrFail($id);
        $companies = CompanyPage::orderBy('name', 'asc')->get();
        return view('pages.edit_product', compact('productPage', 'companies'));
    }
    public function editTopic() {

    }

    // Update the specified company page in storage
    public function updateCompany(Request $request) {
        $request->validate([
            'product_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ], [
            'product_logo.image' => 'The product logo must be an image',
            'product_logo.mimes' => 'The product logo must be a jpeg, png, jpg, or svg file',
            'product_logo.max' => 'The product logo must be no larger than 2MB'
        ]);
        $companyPage = CompanyPage::findOrFail($request->id);
        $logo_changed = !is_null($request->company_logo);
        $logo_exists = !is_null($companyPage->logo_path);

        // delete previous image if it exists
        if($logo_changed && $logo_exists) {
            Storage::delete('public/' . $companyPage->logo_path);
        }

        // create an image
        if($logo_changed) {
            $imageName = time() . '.' . $request->company_logo->extension();
            $image = Image::make($request->file('company_logo'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
            $image->save(storage_path('app/public/images/' . $imageName));
        }

        // make and save all changes to company page
        $companyPage->name = $request->name;
        $companyPage->description = $request->description;
        // applying the settings for image
        if($request->is_default) {
            $companyPage->logo_path = null;
        } else if($logo_changed) {
            $companyPage->logo_path = 'images/' . $imageName;
        }
        $companyPage->website = $request->website;
        $companyPage->industry = $request->industry;
        $companyPage->content = $request->content;
        $companyPage->founding_date = $request->founding_date;
        $companyPage->save();
        
        return view('pages.show_company', compact('companyPage'));
    }

    // Update the specified product page in storage
    public function updateProduct(Request $request) {
        $request->validate([
            'product_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ], [
            'product_logo.image' => 'The product logo must be an image',
            'product_logo.mimes' => 'The product logo must be a jpeg, png, jpg, or svg file',
            'product_logo.max' => 'The product logo must be no larger than 2MB'
        ]);
        $productPage = ProductPage::findOrFail($request->id);
        $logo_changed = !is_null($request->product_logo);
        $logo_exists = !is_null($productPage->logo_path);

        // delete previous image if it exists
        if($logo_changed && $logo_exists) {
            Storage::delete('public/' . $productPage->logo_path);
        }

        // create an image
        if($logo_changed) {
            $imageName = time() . '.' . $request->product_logo->extension();
            $image = Image::make($request->file('product_logo'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
            $image->save(storage_path('app/public/images/' . $imageName));
        }

        // make and save all changes to product page
        $productPage->name = $request->name;
        $productPage->description = $request->description;
        // applying the settings for image
        if($request->is_default) {
            $productPage->logo_path = null;
        } else if($logo_changed) {
            $productPage->logo_path = 'images/' . $imageName;
        }
        $productPage->company_id = $request->company_id;
        $productPage->content = $request->content;
        $productPage->release_date = $request->release_date;
        $productPage->save();

        return view('pages.show_product', compact('productPage'));
    }

    // Delete company page
    public function destroyCompany($id) {
        $companyPage = CompanyPage::findOrFail($id);
        // delete the logo image if it exists
        if(!is_null($companyPage->logo_path)) {
            Storage::delete('public/' . $companyPage->logo_path);
        }
        $companyPage->delete();
        
        // construct pages variable
        $companyPagesQuery = CompanyPage::query();
        $productPagesQuery = ProductPage::query();
        $topicPagesQuery = TopicPage::query();
        $pages = $companyPagesQuery->get()->concat($productPagesQuery->get())->concat($topicPagesQuery->get());
        // retrieve all tags for filtering
        $tags = Tag::all();

        return redirect('/pages');
    }

    // Delete product page
    public function destroyProduct($id) {
        $productPage = ProductPage::findOrFail($id);
        // delete the logo image if it exists
        if(!is_null($productPage->logo_path)) {
            Storage::delete('public/' . $productPage->logo_path);
        }
        $productPage->delete();
        
        // construct pages variable
        $companyPagesQuery = CompanyPage::query();
        $productPagesQuery = ProductPage::query();
        $topicPagesQuery = TopicPage::query();
        $pages = $companyPagesQuery->get()->concat($productPagesQuery->get())->concat($topicPagesQuery->get());
        // retrieve all tags for filtering
        $tags = Tag::all();

        return redirect('/pages');
    }
}
