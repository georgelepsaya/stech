<?php

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
    return view('welcome');
});

Route::get('/pages', [\App\Http\Controllers\PageController::class, 'index'])->name('pages.index');

Route::get('/pages/{id}', [\App\Http\Controllers\PageController::class, 'show']);

Route::get('users', function () {
    return 'users';
});

Route::get('/users/{id}', function ($id) {
    return $id . ' user';
});


