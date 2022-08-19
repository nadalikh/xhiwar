<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class routeController extends Controller
{
    public function root(){
        $categories = DB::table('categories')->select('name')->groupBy('name')->get();
        $products = product::inRandomOrder()->limit(15)->get();
        return view('welcome', compact('categories','products'));
    }
    public function adminRoot(){
        return view('admin.layout.master');
    }
    public function addProduct(){
        $categories = DB::table('categories')->select('name')->groupBy('name')->get();
        return view('admin.add', compact("categories"));
    }
    public function showProduct($productId){
        $categories = DB::table('categories')->select('name')->groupBy('name')->get();
        $product = product::findOrFail($productId);
        $categoryName = $product->category()->first()->name;
        return view('product', compact('product', 'categoryName','categories'));
    }
}