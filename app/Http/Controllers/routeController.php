<?php

namespace App\Http\Controllers;

use App\Models\basket;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class routeController extends Controller
{
    public function root(){
        $basketCount = null;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = DB::table('categories')->select('name')->groupBy('name')->get();
        $products = product::inRandomOrder()->limit(15)->get();
        return view('welcome', compact('categories','products', 'basketCount'));
    }
    public function adminRoot(){
        return view('admin.layout.master');
    }
    public function addProduct(){
        $categories = DB::table('categories')->select('name')->groupBy('name')->get();
        return view('admin.add', compact("categories"));
    }
    public function showProduct($productId){
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = DB::table('categories')->select('name')->groupBy('name')->get();
        $product = product::findOrFail($productId);
        $categoryName = $product->category()->first()->name;
        return view('product', compact('product', 'categoryName','categories', 'basketCount'));
    }
    public function baskets(){
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = DB::table('categories')->select('name')->groupBy('name')->get();
        return view('buying', compact('categories', 'basketCount'));
    }
}
