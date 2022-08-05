<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemsController;
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

Route::get('/dashbord', function () {
    return view('dashbord');
});

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/brand',[BrandController::class,'indexOfBrand'])->name('brand_index');
Route::get('/brand_list',[BrandController::class,'brandList']);
Route::get('brand-edit/{id}',[BrandController::class,'brandDetails']);
Route::post('/brand-data',[BrandController::class,'addOrupdate']);
Route::post('delete_brand',[BrandController::class,'deleteBrand']);


Route::get('/itam',[ItemsController::class,'indexOfBrand'])->name('itam_index');
Route::get('/item-list',[ItemsController::class,'itemList']);
Route::post('/store-update',[ItemsController::class,'storeUpadte']);
Route::get('/item-details/{id}',[ItemsController::class,'itemDetails']);
Route::get('/delete-item/{id}',[ItemsController::class,'itemDelete']);

  // client side

  Route::get('/user_layout', function () {
    return view('client_side.include.user_layout');
});

Route::get('/home',[UserController::class,'home'])->name('home');
Route::get('/checkout',[UserController::class,'checkout'])->name('checkout');
Route::get('/product',[UserController::class,'product'])->name('product');

Route::get('/shop',[ItemsController::class,'shop'])->name('shop');
Route::get('/viewItemDetails/{id}',[ItemsController::class,'viewItemDetails'])->name('viewItemDetails');

  // Add to cart 
Route::get('/cart', [CartController::class,'CartList'])->name('CartList');
Route::get('/view_cart', [CartController::class,'viewCart'])->name('viewCart');
Route::get('/addtocart/{item_id}',[CartController::class,'addtoCart']);
Route::get('/update_cart/{item_id}/{quantity}',[CartController::class,'updateCart']);
Route::get('/deletecart/{item_id}',[CartController::class,'deletecart']);









