<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'App\Http\Controllers\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'App\Http\Controllers\Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');
    });

    Route::resource('brands', BrandController::class , [
        'names' => [
            'index' => 'admin.brands.index',
            'create' => 'admin.brands.create',
            'store' => 'admin.brands.store',
            'edit' => 'admin.brands.edit',
            'update' => 'admin.brands.update',
            'destroy' => 'admin.brands.destroy',
        ]
    ])->except('show');

    Route::resource('categories', CategoryController::class , [
        'names' => [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]
    ])->except('show');
});
