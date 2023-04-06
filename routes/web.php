<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/login', function () {
    return view('login');
});

// Route::middleware(['auth', 'admin'])->controller(CategoryController::class)->group(function () {
//     Route::get('/dashboard/categories', 'allCategory')->name('manage_category.all');
//     Route::get('/dashboard/category/create', 'createCategory')->name('manage_category.create');
//     Route::post('/dashboard/category/create', 'storeCategory')->name('manage_category.store');
//     Route::get('/dashboard/category/{category:id}', 'detailCategory')->name('manage_category.detail');
//     Route::get('/dashboard/category/{category:id}/update', 'updateCategory')->name('manage_category.update');
//     Route::patch('/dashboard/category/{category:id}', 'patchCategory')->name('manage_category.patch');
//     Route::delete('/dashboard/category/{category:id}/delete', 'deleteCategory')->name('manage_category.delete');
// });

Route::controller(CategoryController::class)->group(function () {
    Route::get('/dashboard/categories', 'allCategory')->name('manage_category.all');
    Route::get('/dashboard/categories/create', 'createCategory')->name('manage_category.create');
    Route::post('/dashboard/categories/create', 'storeCategory')->name('manage_category.store');
    Route::get('/dashboard/categories/{category:id}/update', 'updateCategory')->name('manage_category.update');
    Route::patch('/dashboard/category/{category:id}/update','patchCategory')->name('manage_category.patch');
    Route::delete('/dashboard/category/{category:id}/delete','deleteCategory')->name('manage_category.delete');
});