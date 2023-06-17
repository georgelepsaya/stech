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
    # Display listings of all company pages #

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
    
    # Display the specified company page

    public function showCompany($id) {
        $companyPage = CompanyPage::findOrFail($id);
        return view('pages.show_company', ['companyPage' => $companyPage]);
    }

    public function showProduct($id) {
        $productPage = ProductPage::findOrFail($id);
        return view('pages.show_product', ['productPage' => $productPage]);
    }

    public function showTopic($id) {
        $topicPage = TopicPage::findOrFail($id);
        return view('pages.show_topic', ['topicPage' => $topicPage]);
    }

    # Show the form for creating a new page #

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

    # Store a newly created page in storage #

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

    public function storeProduct(Request $request) {
        // dd($request->toArray());
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

    public function storeTopic(Request $request) {
        // validate the input
        $request->validate([
            'topic_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ], [
            'topic_image.image' => 'The company logo must be an image',
            'topic_image.mimes' => 'The company logo must be a jpeg, png, jpg, or svg file',
            'topic_image.max' => 'The company logo must be no larger than 2MB'
        ]);

        // after passing validation
        $custom_logo = !is_null($request->topic_image);
        if($custom_logo) {
            $imageName = time() . '.' . $request->topic_image->extension();
            $image = Image::make($request->file('topic_image'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
            $image->save(storage_path('app/public/images/' . $imageName));
        }

        // create a new topic page and save all data  
        $topicPage = new TopicPage();
        $topicPage->name = $request->name;
        $topicPage->description = $request->description;
        $topicPage->image_url = (($custom_logo)? 'images/' . $imageName : null);
        $topicPage->content = $request->content;
        $topicPage->save();

        return redirect()->route('pages.index')->with('success', 'Topic page created successfully.');
    }

    # Show the form for editing the specified page #

    public function editCompany($id) {
        $companyPage = CompanyPage::findOrFail($id);
        return view('pages.edit_company', compact('companyPage'));
    }
    public function editProduct($id) {
        $productPage = ProductPage::findOrFail($id);
        $companies = CompanyPage::orderBy('name', 'asc')->get();
        return view('pages.edit_product', compact('productPage', 'companies'));
    }
    public function editTopic($id) {
        $topicPage = TopicPage::findOrFail($id);
        return view('pages.edit_topic', compact('topicPage'));
    }
    
    # Update pages #

    public function updateCompany(Request $request) {
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
        $companyPage = CompanyPage::findOrFail($request->id);
        $logo_changed = !is_null($request->company_logo);
        $logo_exists = !is_null($companyPage->logo_path);

        // save the image
        if($request->is_default) {
            if($logo_exists) {
                Storage::delete('public/' . $companyPage->logo_path);
                $companyPage->logo_path = null;
            }
        } else {
            if($logo_changed) {
                // delete an image if it exists
                if($logo_exists) {
                    Storage::delete('public/' . $companyPage->logo_path);
                }
                // create an image
                $imageName = time() . '.' . $request->company_logo->extension();
                $image = Image::make($request->file('company_logo'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                });
                $image->save(storage_path('app/public/images/' . $imageName));
                $companyPage->logo_path = 'images/' . $imageName;
            }
        }

        // make and save all other changes to the company page
        $companyPage->name = $request->name;
        $companyPage->description = $request->description;
        $companyPage->website = $request->website;
        $companyPage->industry = $request->industry;
        $companyPage->content = $request->content;
        $companyPage->founding_date = $request->founding_date;
        $companyPage->save();
        
        return view('pages.show_company', compact('companyPage'));
    }

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

        // save the image
        if($request->is_default) {
            if($logo_exists) {
                Storage::delete('public/' . $productPage->logo_path);
                $productPage->logo_path = null;
            }
        } else {
            if($logo_changed) {
                // delete an image if it exists
                if($logo_exists) {
                    Storage::delete('public/' . $productPage->logo_path);
                }
                // create an image
                $imageName = time() . '.' . $request->product_logo->extension();
                $image = Image::make($request->file('product_logo'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                });
                $image->save(storage_path('app/public/images/' . $imageName));
                $productPage->logo_path = 'images/' . $imageName;
            }
        }
        // make and save all other changes to the product page
        $productPage->name = $request->name;
        $productPage->description = $request->description;
        $productPage->company_id = $request->company_id;
        $productPage->content = $request->content;
        $productPage->release_date = $request->release_date;
        $productPage->save();

        return view('pages.show_product', compact('productPage'));
    }

    public function updateTopic(Request $request) {
        $request->validate([
            'topic_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ], [
            'topic_image.image' => 'The product logo must be an image',
            'topic_image.mimes' => 'The product logo must be a jpeg, png, jpg, or svg file',
            'topic_image.max' => 'The product logo must be no larger than 2MB'
        ]);
        $topicPage = TopicPage::findOrFail($request->id);
        $logo_exists = !is_null($topicPage->image_url);
        $logo_changed = !is_null($request->topic_image);

        // save the image
        if($request->is_default) {
            if($logo_exists) {
                Storage::delete('public/' . $topicPage->image_url);
                $topicPage->image_url = null;
            }
        } else {
            if($logo_changed) {
                // delete an image if it exists
                if($logo_exists) {
                    Storage::delete('public/' . $topicPage->image_url);
                }
                // create an image
                $imageName = time() . '.' . $request->topic_image->extension();
                $image = Image::make($request->file('topic_image'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                });
                $image->save(storage_path('app/public/images/' . $imageName));
                $topicPage->image_url = 'images/' . $imageName;
            }
        }
        // make and save all other changes to topic page
        $topicPage->name = $request->name;
        $topicPage->description = $request->description;
        $topicPage->content = $request->content;
        $topicPage->save();

        return view('pages.show_topic', compact('topicPage'));
    }

    # Delete pages #

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

    public function destroyTopic($id) {
        $topicPage = TopicPage::findOrFail($id);
        // delete the logo image if it exists
        if(!is_null($topicPage->image_url)) {
            Storage::delete('public/' . $topicPage->image_url);
        }
        $topicPage->delete();

        return redirect('/pages');
    }
}
