<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product', function(){
    $category = new \App\Models\category();
    $category->name = "test cat";
//    $category->save();
    $product = new \App\Models\product();
    $product->name = "test product";
    $product->save();
    $product->category()->save($category);
    $category->products()->save($product);
});
Route::get('/signing_form', function(){})->name("signing_form");
Route::get('/product/{id}', function(){})->name("product");
