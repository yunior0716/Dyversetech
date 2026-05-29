<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProductController;

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

Route::get('/',[HomeController::class,'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');


// ── Admin routes (require auth + admin middleware) ──────────────────────
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    Route::get('/view_catagory',[CategoryController::class,'view_catagory']);
    Route::post('/add_catagory',[CategoryController::class,'add_catagory']);
    Route::delete('/delete_catagory/{id}',[CategoryController::class,'delete_catagory']);

    Route::get('/view_brand',[BrandController::class,'view_brand']);
    Route::post('/add_brand',[BrandController::class,'add_brand']);
    Route::delete('/delete_brand/{id}',[BrandController::class,'delete_brand']);

    Route::get('/view_model',[ModelsController::class,'view_model']);
    Route::post('/add_model',[ModelsController::class,'add_model']);
    Route::delete('/delete_model/{id}',[ModelsController::class,'delete_model']);

    Route::get('/view_operator',[OperatorController::class,'view_operator']);
    Route::post('/add_operator',[OperatorController::class,'add_operator']);
    Route::delete('/delete_operator/{id}',[OperatorController::class,'delete_operator']);

    Route::get('/view_product',[ProductController::class,'view_product']);
    Route::post('/add_product',[ProductController::class,'add_product']);
    Route::get('/show_product',[ProductController::class,'show_product']);
    Route::delete('/delete_product/{id}',[ProductController::class,'delete_product']);
    Route::get('/update_product/{id}',[ProductController::class,'update_product']);
    Route::post('/update_product_confirm/{id}',[ProductController::class,'update_product_confirm']);

    Route::get('/order',[AdminController::class,'order']);
    Route::post('/delivered/{id}',[AdminController::class,'delivered']);
    Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
    Route::get('/send_email/{id}',[AdminController::class,'send_email']);
    Route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);

    Route::get('/search',[AdminController::class,'searchdata']);
    Route::get('/message',[AdminController::class,'message']);
    Route::get('/customer',[AdminController::class,'customer']);
});


// ── Authenticated user routes ───────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
    Route::get('/show_cart',[HomeController::class,'show_cart']);
    Route::delete('/remove_cart/{id}',[HomeController::class,'remove_cart']);
    Route::post('/cash_order',[HomeController::class,'cash_order']);
    Route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);
    Route::post('stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');
    Route::get('/show_order',[HomeController::class,'show_order']);
    Route::post('/cancel_order/{id}',[HomeController::class,'cancel_order']);
    Route::post('/add_comment',[HomeController::class,'add_comment']);
    Route::post('/add_reply',[HomeController::class,'add_reply']);
});


// ── Public routes ───────────────────────────────────────────────────────
Route::get('/product_details/{id}',[HomeController::class,'product_details']);
Route::get('/product_search',[ProductController::class,'product_search']);
Route::get('/products',[ProductController::class,'product']);
Route::get('/search_product',[ProductController::class,'search_product']);
Route::get('/filters',[ProductController::class,'getFilters']);
Route::get('/contact',[HomeController::class,'contact']);
Route::post('/add_contact',[HomeController::class,'add_contact']);

