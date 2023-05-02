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

Route::get('/pages', [\App\Http\Controllers\CompanyPageController::class, 'index']);

Route::post('/pages', function () {
    return 'post to pages';
});

Route::get('/pages/{id}', function ($id) {
    return $id . ' page';
});

Route::get('users', function () {
    return 'users';
});

Route::get('/users/{id}', function ($id) {
    return $id . ' user';
});


