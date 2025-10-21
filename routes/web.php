<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersControllers;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;

Auth::routes();

Route::get('/', function () {
    return redirect('login');
})->middleware('guest');
Route::get('/', function () {
    return redirect('dashboard');
})->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('/dashboard', DashboardController::class);

    Route::resource('/products', ProductsController::class);

    Route::resource('/categories', CategoriesController::class);

    Route::resource('/settings', SettingsController::class);

    Route::resource('/roles', RolesController::class);

    Route::resource('/users', UsersControllers::class);

});
