<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\PageController;
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

Route::get('/feed', function () {
    return view('feed');
})->middleware(['auth', 'verified'])->name('feed');

Route::middleware('auth')->group(function () {
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    // Company
    Route::get('/pages/companies/create', [PageController::class, 'createCompany'])->name('pages.create_company');
    Route::post('/pages/companies', [PageController::class, 'storeCompany'])->name('pages.store_company');
    Route::get('/pages/companies/{id}', [PageController::class, 'showCompany'])->name('pages.show_company');
    Route::get('/pages/companies/{id}/edit', [PageController::class, 'editCompany'])->name('pages.edit_company');
    Route::put('/pages/companies', [PageController::class, 'updateCompany'])->name('pages.update_company');
    // Product
    Route::get('/pages/products/create', [PageController::class, 'createProduct'])->name('pages.create_product');
    Route::get('/pages/products/{id}', [PageController::class, 'showProduct'])->name('pages.show_product');
    Route::post('/pages/products', [PageController::class, 'storeProduct'])->name('pages.store_product');
    Route::get('/pages/products/{id}/edit', [PageController::class, 'editProduct'])->name('pages.edit_product');
    Route::put('/pages/products', [PageController::class, 'updateProduct'])->name('pages.update_product');
    // Topics
    Route::get('/pages/topics/create', [PageController::class, 'createTopic'])->name('pages.create_topic');
    Route::get('/pages/topics/{id}', [PageController::class, 'showTopic'])->name('pages.show_topic');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// 