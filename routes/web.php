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
Route::get('/', [\App\Http\Controllers\routeController::class, "root"])->name('root');
Route::get('/signing_form', [\App\Http\Controllers\routeController::class, "signing_form"])->name("signing_form");
Route::get('/product/{id}', [\App\Http\Controllers\routeController::class, 'showProduct'])->name("product");
Route::post('/signin', [\App\Http\Controllers\userController::class, "register"]);
Route::get('logout', [\App\Http\Controllers\userController::class, "logout"])->name('logout');
Route::post('login', [\App\Http\Controllers\userController::class, "login"])->name('login');
Route::get('category/{id}', [\App\Http\Controllers\routeController::class, "category"])->name('category');
Route::get('search', [\App\Http\Controllers\routeController::class, "search"])->name('search');
Route::get('exactSearch', [\App\Http\Controllers\routeController::class, "exactSearch"])->name('exactSearch');

Route::middleware('auth')->group(function(){

    Route::post("addToBasket", [\App\Http\Controllers\userController::class, 'addToBasket'])->name('addToBasket');
    Route::get('baskets',[\App\Http\Controllers\routeController::class,'baskets'])->name('baskets');
    Route::get('getBaskets',[\App\Http\Controllers\userController::class,'getBaskets'])->name('getBaskets');
    Route::get('deleteBasket',[\App\Http\Controllers\userController::class,'deleteBasket'])->name('deleteBasket');
    Route::get('totalPrice',[\App\Http\Controllers\userController::class,'totalPrice'])->name('totalPrice');
    Route::post('payment',[\App\Http\Controllers\userController::class,'payment'])->name('payment');
    Route::get('callback',[\App\Http\Controllers\routeController::class,'callback'])->name('callback');
    Route::get('myOrders',[\App\Http\Controllers\routeController::class,'myOrders'])->name('myOrders');

});

//admin route group
Route::prefix("admin")->middleware('admin')->group(function (){
    Route::get('/',[\App\Http\Controllers\routeController::class, "adminRoot"])->name('admin.root');
    Route::get('addProduct', [\App\Http\Controllers\routeController::class, "addProduct"])->name("admin.addProduct");
    Route::post('addProduct',[\App\Http\Controllers\adminController::class, 'createProduct'])->name('admin.createProduct');
    Route::get('manageUser',[\App\Http\Controllers\routeController::class, "manageUser"] )->name('admin.manageUser');
    Route::get('changeRole',[\App\Http\Controllers\adminController::class, "changeRole"] )->name('admin.changeRole');
    Route::get('transactions',[\App\Http\Controllers\routeController::class, "transactions"] )->name('admin.transactions');
});
