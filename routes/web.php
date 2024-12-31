<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // Make sure to import the ProductController
use App\Http\Controllers\SkinProfileFormController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('Product', ProductController::class);
Route::resource('SkinProfileForm', SkinProfileFormController::class);