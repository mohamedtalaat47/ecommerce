<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

require 'admin.php';

Route::view('/', 'site.pages.homepage');

Route::get('/category/{slug}', 'App\Http\Controllers\Site\CategoryController@show')->name('category.show');
