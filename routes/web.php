<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/',function(){
    return view('frontpage.main');
})->name('main');

Route::get('/dashboard',function(){
    return view('admin.dashboard-overview');
})->name('dashboard')->middleware(['auth', 'admin']);

Route::controller(UserController::class)->group(function(){
    Route::get('/register','register')->name('register');
    Route::post('/register','attemptRegister')->name('attempt_register');
    Route::get('/login','login')->name('login')->middleware('guest');
    Route::post('/login','attemptLogin')->name('attempt_login');
    Route::get('/logout','logout')->name('logout')->middleware('auth');
    Route::get('/dashboard/customers', 'allCustomers')->name('manage_customer.all');

});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/dashboard/categories', 'allCategory')->name('manage_category.all');
    Route::get('/dashboard/category/create', 'createCategory')->name('manage_category.create');
    Route::post('/dashboard/category/create', 'storeCategory')->name('manage_category.store');
    Route::get('/dashboard/category/{category:id}/update', 'updateCategory')->name('manage_category.update');
    Route::patch('/dashboard/category/{category:id}/update','patchCategory')->name('manage_category.patch');
    Route::delete('/dashboard/category/{category:id}/delete','deleteCategory')->name('manage_category.delete');
    //extend
    Route::get('/dashboard/category/get-slug','getSlug');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/dashboard/products', 'allProduct')->name('manage_product.all');
    Route::get('/dashboard/product/create', 'createProduct')->name('manage_product.create');
    Route::post('/dashboard/product/create', 'storeProduct')->name('manage_product.store');
    Route::get('/dashboard/product/{product:product_code}/update', 'updateProduct')->name('manage_product.update');
    Route::patch('/dashboard/product/{product:product_code}/update','patchProduct')->name('manage_product.patch');
    Route::delete('/dashboard/product/{product:product_code}/delete','deleteProduct')->name('manage_product.delete');
    // extended
     Route::get('/dashboard/product/get-product-code','getProductCode');
});

Route::controller(FeedbackController::class)->group(function(){
    Route::get('/dashboard/feedback', 'allFeedback')->name('manage_feedback.all');
    Route::get('/dashboard/feedback/create', 'createFeedback')->name('manage_feedback.create');
    Route::post('/dashboard/feedback/create', 'storeFeedback')->name('manage_feedback.store');
    Route::get('/dashboard/feedback/{feedback:id}/update', 'updateFeedback')->name('manage_feedback.update');
    Route::patch('/dashboard/feedback/{feedback:id}/update','patchFeedback')->name('manage_feedback.patch');
    Route::delete('/dashboard/feedback/{feedback:id}/delete','deleteFeedback')->name('manage_feedback.delete');
});