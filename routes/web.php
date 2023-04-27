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

route::get('/',[HomeController::class,'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');

route::get('/view_catagory',[CategoryController::class,'view_catagory']);
route::post('/add_catagory',[CategoryController::class,'add_catagory']);
route::get('/delete_catagory/{id}',[CategoryController::class,'delete_catagory']);


route::get('/view_brand',[BrandController::class,'view_brand']);
route::post('/add_brand',[BrandController::class,'add_brand']);
route::get('/delete_brand/{id}',[BrandController::class,'delete_brand']);

route::get('/view_model',[ModelsController::class,'view_model']);
route::post('/add_model',[ModelsController::class,'add_model']);
route::get('/delete_model/{id}',[ModelsController::class,'delete_model']);

route::get('/view_operator',[OperatorController::class,'view_operator']);
route::post('/add_operator',[OperatorController::class,'add_operator']);
route::get('/delete_operator/{id}',[OperatorController::class,'delete_operator']);


route::get('/view_product',[ProductController::class,'view_product']);
route::post('/add_product',[ProductController::class,'add_product']);
route::get('/show_product',[ProductController::class,'show_product']);
route::get('/delete_product/{id}',[ProductController::class,'delete_product']);
route::get('/update_product/{id}',[ProductController::class,'update_product']);
route::post('/update_product_confirm/{id}',[ProductController::class,'update_product_confirm']);


route::get('/order',[AdminController::class,'order']);
route::get('/delivered/{id}',[AdminController::class,'delivered']);
route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
route::get('/send_email/{id}',[AdminController::class,'send_email']);

route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);


route::get('/search',[AdminController::class,'searchdata']);

route::get('/message',[AdminController::class,'message']);

route::get('/customer',[AdminController::class,'customer']);


 

route::get('/product_details/{id}',[HomeController::class,'product_details']);

route::post('/add_cart/{id}',[HomeController::class,'add_cart']);


route::get('/show_cart',[HomeController::class,'show_cart']);

route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);


route::get('/cash_order/{totalproduct}',[HomeController::class,'cash_order']);


route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);



Route::post('stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');


route::get('/show_order',[HomeController::class,'show_order']);



route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);


route::post('/add_comment',[HomeController::class,'add_comment']);


route::post('/add_reply',[HomeController::class,'add_reply']);


route::get('/product_search',[ProductController::class,'product_search']);
route::get('/products',[ProductController::class,'product']);
route::get('/search_product',[ProductController::class,'search_product']);
route::get('/filters',[ProductController::class,'getFilters']);



route::get('/contact',[HomeController::class,'contact']);

route::post('/add_contact',[HomeController::class,'add_contact']);




