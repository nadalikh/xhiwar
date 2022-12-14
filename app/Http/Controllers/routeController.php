<?php

namespace App\Http\Controllers;

use App\Models\basket;
use App\Models\category;
use App\Models\order;
use App\Models\product;
use App\Models\transaction;
use App\Models\transactionLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class routeController extends Controller
{
    public function root(){
        $basketCount = null;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = category::all();
        $products = product::inRandomOrder()->limit(15)->get();
        return view('welcome', compact('categories','products', 'basketCount'));
    }
    public function adminRoot(){
        return view('admin.layout.master');
    }
    public function signing_form(Request $request){
        $email =($request->email) ? $request->only('email')['email']:"";
        $basketCount = null;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = category::all();
        return view('signin', compact('categories','basketCount', 'email'));

    }
    public function addProduct(){
        $categories = category::all();
        return view('admin.add', compact("categories"));
    }
    public function showProduct($productId){
        $basketCount = null;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = category::all();
        $product = product::findOrFail($productId);
        $category = $product->category()->first();
        return view('product', compact('product', 'category','categories', 'basketCount'));
    }
    public function baskets(){
        $basketCount = null;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = category::all();

        return view('buying', compact('categories', 'basketCount'));
    }
    public function category($categoryId){
        $products = product::whereCategoryId($categoryId)->get();
        $basketCount = null;
        $shouldBeScrolled = true;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = category::all();
        return view('welcome', compact('categories','products', 'basketCount', 'shouldBeScrolled'));
    }
    public function search(Request $request){
        $content = $request->validate([
            'content' => "required|max:30"
        ]);
        $products = product::whereName($content)->get();
        $categories = category::all();
        $basketCount = null;
        $shouldBeScrolled = true;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        return view('welcome', compact('categories','products', 'basketCount', 'shouldBeScrolled'));
    }
    public function exactSearch(Request $request){
        $content = $request->validate([
            'name' => "required|max:30",
            'brand' => "required|max:30",
            'country_manufacturer' => "required|max:30"
        ]);
        $products = product::whereName($content['name'])->whereBrand($content['brand'])->whereCountryManufacturer($content['country_manufacturer'])->get();
        $categories = category::all();
        $basketCount = null;
        $shouldBeScrolled = true;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        return view('welcome', compact('categories','products', 'basketCount', 'shouldBeScrolled'));
    }
    public function callback(){
        try {
            $gateway = \Gateway::verify('zarinpal');
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
            basket::whereUserId(Auth::user()->id)->delete();
            return redirect('/')->with('success', '???????????? ?????? ???? ???????????? ?????????? ????');
        } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {
            echo $e->getMessage() . "<br>";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function myOrders(){
        $basketCount = null;
        if(Auth::check())
            $basketCount = sizeof(basket::whereUserId(Auth::user()->id)->get());
        $categories = category::all();
        $orders = order::whereUserId(Auth::user()->id)->get();
        foreach ($orders as $order){
            $transaction = transaction::find($order->transaction_id);
            $order->tracking_code = $transaction->tracking_code;
            if($log = transactionLog::whereTransactionId(strval($order->transaction_id))->first())
                $order->message = $log->result_message;
            else
                $order->message = "???????? ???????? ?????????? ?????? ??????.";
        }
        return view('myOrders',compact('basketCount', 'orders', 'categories'));

    }
    public function manageUser(){
        $users = User::all();
        return view('admin.manageUser', compact('users'));
    }

    public function transactions(){
        $orders = order::all();
        foreach ($orders as $order){
            $transaction = transaction::find($order->transaction_id);
            $order->tracking_code = $transaction->tracking_code;
            if($log = transactionLog::whereTransactionId(strval($order->transaction_id))->first())
                $order->message = $log->result_message;
            else
                $order->message = "???????? ???????? ?????????? ?????? ??????.";
        }
        return view('admin.transactions', compact('orders'));
    }

}
