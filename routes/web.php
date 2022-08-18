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

//Route::get('/product', function(){
//    $category = new \App\Models\category();
//    $category->name = "test cat";
//    $category->save();
//    $product = new \App\Models\product();
//    $product->name = "test product";
////    $product->save();
//    $product1 = new \App\Models\product();
//    $product1->name = "test product";
////    $product1->save();
//    $product->category()->associate($category)->save();
//    $category->products()->saveMany([$product, $product1]);
//});

Route::get('/', [\App\Http\Controllers\routeController::class, "root"])->name('root');
Route::get('/signing_form', function(){ return view('signin');})->name("signing_form");
Route::get('/product/{id}', function(){})->name("product");
Route::get('/orders', function(){})->name("orders");
Route::post('/signin', [\App\Http\Controllers\userController::class, "register"]);
Route::get('logout', [\App\Http\Controllers\userController::class, "logout"])->name('logout');
Route::post('login', [\App\Http\Controllers\userController::class, "login"])->name('login');
//admin route group
Route::prefix("admin")->middleware('admin')->group(function (){

    Route::get('/',[\App\Http\Controllers\routeController::class, "adminRoot"])->name('admin.root');
    Route::get('addProduct', [\App\Http\Controllers\routeController::class, "addProduct"])->name("admin.addProduct");
    Route::post('addProduct',[\App\Http\Controllers\adminController::class, 'createProduct'])->name('admin.createProduct');
});
