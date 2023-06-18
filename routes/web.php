<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\PageController;
use \App\Http\Controllers\ArticleController;
use \App\Http\Controllers\UserController;
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
    return redirect('feed'); // whoa that looks so promising already!
});

// Route::get('/feed', function () {
//     return view('feed');
// })->middleware(['auth', 'verified'])->name('feed');

Route::middleware('auth')->group(function () {
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/feed', [ArticleController::class, 'index'])->name('feed.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    // Company
    Route::get('/pages/companies/create', [PageController::class, 'createCompany'])->name('pages.create_company');
    Route::post('/pages/companies', [PageController::class, 'storeCompany'])->name('pages.store_company');
    Route::get('/pages/companies/{id}', [PageController::class, 'showCompany'])->name('pages.show_company');
    Route::get('/pages/companies/{id}/edit', [PageController::class, 'editCompany'])->name('pages.edit_company');
    Route::put('/pages/companies', [PageController::class, 'updateCompany'])->name('pages.update_company');
    Route::delete('/pages/companies/{id}', [PageController::class, 'destroyCompany'])->name('pages.delete_company');
    // Product
    Route::get('/pages/products/create', [PageController::class, 'createProduct'])->name('pages.create_product');
    Route::post('/pages/products', [PageController::class, 'storeProduct'])->name('pages.store_product');
    Route::get('/pages/products/{id}', [PageController::class, 'showProduct'])->name('pages.show_product');
    Route::get('/pages/products/{id}/edit', [PageController::class, 'editProduct'])->name('pages.edit_product');
    Route::put('/pages/products', [PageController::class, 'updateProduct'])->name('pages.update_product');
    Route::delete('/pages/products/{id}', [PageController::class, 'destroyProduct'])->name('pages.delete_product');
    // Topic
    Route::get('/pages/topics/create', [PageController::class, 'createTopic'])->name('pages.create_topic');
    Route::post('/pages/topics', [PageController::class, 'storeTopic'])->name('pages.store_topic');
    Route::get('/pages/topics/{id}', [PageController::class, 'showTopic'])->name('pages.show_topic');
    Route::get('/pages/topics/{id}/edit', [PageController::class, 'editTopic'])->name('pages.edit_topic');
    Route::put('/pages/topics', [PageController::class, 'updateTopic'])->name('pages.update_topic');
    Route::delete('/pages/topics/{id}', [PageController::class, 'destroyTopic'])->name('pages.delete_topic');
    // Article
    Route::get('/feed/articles/create', [ArticleController::class, 'create'])->name('feed.create_article');
    Route::post('/feed/articles', [ArticleController::class, 'store'])->name('feed.store_article');
    Route::get('/feed/articles/{id}', [ArticleController::class, 'show'])->name('feed.show_article');
    Route::get('/feed/articles/{id}/edit', [ArticleController::class, 'edit'])->name('feed.edit_article');
    Route::put('/feed/articles', [ArticleController::class, 'update'])->name('feed.update_article');
    Route::delete('/feed/articles/{id}', [ArticleController::class, 'destroy'])->name('feed.delete_article');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// 