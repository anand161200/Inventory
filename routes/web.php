<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ItemsController;
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
})->name('index');;


Route::get('/brand',[BrandController::class,'indexOfBrand'])->name('brand_index');
Route::get('/brand_list',[BrandController::class,'brandList']);
Route::get('brand-edit/{id}',[BrandController::class,'brandDetails']);
Route::post('/brand-data',[BrandController::class,'addOrupdate']);
Route::post('delete_brand',[BrandController::class,'deleteBrand']);


Route::get('/itam',[ItemsController::class,'indexOfBrand'])->name('itam_index');
Route::get('/item-list',[ItemsController::class,'itemList']);
Route::post('/store-data',[ItemsController::class,'storeData']);
Route::get('/item-details/{id}',[ItemsController::class,'itemDetails']);
Route::get('/item-delete/{id}',[ItemsController::class,'itemDelete']);





