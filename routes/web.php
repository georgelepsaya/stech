<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\PageController;
use \App\Http\Controllers\ArticleController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ContributorController;
use \App\Http\Controllers\ReviewController;
use \App\Http\Controllers\NotificationController;
use \App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    App::setLocale('lv');
    return view('welcome');
})->name('welcome');

Route::get('/language/{slug}', function ($slug) {
    //dd($slug);
    if($slug == 'lv') {
        Cookie::queue('lang', 'lv', 9999999);
    } else {
        Cookie::queue('lang', 'en', 9999999);
    }
    return back();
})->name('lang');

// Route::get('/feed', function () {
//     return view('feed');
// })->middleware(['auth', 'verified'])->name('feed');

Route::group(['middleware' => ['auth','langset']], function () {
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/feed', [ArticleController::class, 'index'])->name('feed.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/admin/', [PageController::class, 'adminPanel'])->name('pages.admin');

    // Delete requests
    Route::get('admin/pages/delete', [PageController::class, 'deleteRequestIndex'])->name('requests.delete_index');
    Route::put('/pages/companies/delete', [PageController::class, 'companyDeleteRequest'])->name('pages.company_delete_request');
    Route::put('/pages/products/delete', [PageController::class, 'productDeleteRequest'])->name('pages.product_delete_request');
    Route::put('/pages/topics/delete', [PageController::class, 'topicDeleteRequest'])->name('pages.topic_delete_request');
    Route::delete('admin/pages/delete', [PageController::class, 'destroy'])->name('pages.delete');
    // Create requests
    Route::get('admin/pages/approve', [PageController::class, 'createRequestIndex'])->name('requests.create_index');
    Route::get('admin/pages/show', [PageController::class, 'show'])->name('pages.show');
    Route::put('admin/pages/approve', [PageController::class, 'approve'])->name('pages.approve');
    // Contributors
    Route::post('/pages/contributors', [ContributorController::class, 'store'])->name('requests.store_contributor');
    Route::get('admin/contributors', [ContributorController::class, 'pendingIndex'])->name('requests.contributors');
    Route::put('admin/contributors', [ContributorController::class, 'approveContribution'])->name('requests.approve_contribution');
    // Users
    Route::post('/users/{id}/follow', [UserController::class, 'follow'])->name('users.follow');
    Route::get('/users/{id}/followers', [UserController::class, 'followers'])->name('users.followers');
    Route::get('/users/{id}/following', [UserController::class, 'following'])->name('users.following');
    Route::put('/users/{id}', [UserController::class, 'access'])->name('users.access');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/interests', [UserController::class, 'interests'])->name('users.interests');
    Route::put('/users/{id}/interests', [UserController::class, 'updateInterests'])->name('users.update_interests');
    Route::get('/users/{id}/contributions', [UserController::class, 'contributions'])->name('users.contributions');

    // Bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks', [BookmarkController::class, 'destroy'])->name('bookmarks.delete');
    // Company
    Route::get('/pages/companies/create', [PageController::class, 'createCompany'])->name('pages.create_company');
    Route::post('/pages/companies', [PageController::class, 'storeCompany'])->name('pages.store_company');
    Route::get('/pages/companies/{id}', [PageController::class, 'showCompany'])->name('pages.show_company');
    Route::get('/pages/companies/{id}/edit', [PageController::class, 'editCompany'])->name('pages.edit_company');
    Route::put('/pages/companies', [PageController::class, 'updateCompany'])->name('pages.update_company');
    Route::delete('admin/pages/companies/{id}', [PageController::class, 'destroyCompany'])->name('pages.delete_company');
    Route::get('/pages/companies/{id}/contributors', [PageController::class, 'showCompanyContributors'])->name('pages.company_contributors');
    // Product
    Route::get('/pages/products/create', [PageController::class, 'createProduct'])->name('pages.create_product');
    Route::post('/pages/products', [PageController::class, 'storeProduct'])->name('pages.store_product');
    Route::get('/pages/products/{id}', [PageController::class, 'showProduct'])->name('pages.show_product');
    Route::get('/pages/products/{id}/edit', [PageController::class, 'editProduct'])->name('pages.edit_product');
    Route::put('/pages/products', [PageController::class, 'updateProduct'])->name('pages.update_product');
    Route::delete('admin/pages/products/{id}', [PageController::class, 'destroyProduct'])->name('pages.delete_product');
    Route::get('/pages/products/{id}/contributors', [PageController::class, 'showProductContributors'])->name('pages.product_contributors');
    // Topic
    Route::get('/pages/topics/create', [PageController::class, 'createTopic'])->name('pages.create_topic');
    Route::post('/pages/topics', [PageController::class, 'storeTopic'])->name('pages.store_topic');
    Route::get('/pages/topics/{id}', [PageController::class, 'showTopic'])->name('pages.show_topic');
    Route::get('/pages/topics/{id}/edit', [PageController::class, 'editTopic'])->name('pages.edit_topic');
    Route::put('/pages/topics', [PageController::class, 'updateTopic'])->name('pages.update_topic');
    Route::delete('admin/pages/topics/{id}', [PageController::class, 'destroyTopic'])->name('pages.delete_topic');
    Route::get('/pages/topics/{id}/contributors', [PageController::class, 'showTopicContributors'])->name('pages.topic_contributors');
    // Article
    Route::get('/feed/articles/create', [ArticleController::class, 'create'])->name('feed.create_article');
    Route::post('/feed/articles', [ArticleController::class, 'store'])->name('feed.store_article');
    Route::get('/feed/articles/{id}', [ArticleController::class, 'show'])->name('feed.show_article');
    Route::get('/feed/articles/{id}/edit', [ArticleController::class, 'edit'])->name('feed.edit_article');
    Route::put('/feed/articles', [ArticleController::class, 'update'])->name('feed.update_article');
    Route::delete('/feed/articles/{id}', [ArticleController::class, 'destroy'])->name('feed.delete_article');
    // Reviews
    Route::get('/reviews/create/{article_id}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.delete');
    // Notifications
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'toggleRead'])->name('notifications.read');
    Route::get('/notifications/{id}', [NotificationController::class, 'index'])->name('notifications.show');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//
