<?php

namespace App\Http\Controllers;

use App\Models\basket;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class userController extends Controller
{
    private array $registerRule = [
        'email' => "email|required|max:25|unique:users",
        'password' => "required|confirmed|min:5|max:15",
        'name' => "required|max:15"
    ];
    private array $registerMessage = [
        'email.email' => "فرمت ایمیل وارد شده اشتباه است",
        'email.required' => "وارد کردن ایمیل اجباری است",
        'email.max' => "ایمیل باید شامل حداکثر 15 کاراکتر باشد",
        'email.unique' => "ایمیل وارد شده تکراری است",
        'password.required' => "وارد کردن پسورد اجباری است",
        'password.confirmed' => "پسورد ها همخوانی ندارند",
        'password.min' => "پسورد باید حداقل 5 کاراکتر باشد",
        'password.max' => "پسورد باید شامل حداکثر 15 کاراکتر باشد",
        'name.required' => "وارد کردن نام جباری است",
        'name.max' => "نام باید شامل حداکثر 15 کاراکتر باشد"
    ];
    private array $loginRules = [
        'email' => "email|required|max:25",
        'password' => "required|min:5|max:15",
    ];
    private array $loginMessages = [
        'email.email' => "فرمت ایمیل وارد شده اشتباه است",
        'email.required' => "وارد کردن ایمیل اجباری است",
        'email.max' => "ایمیل باید شامل حداکثر 15 کاراکتر باشد",
        'password.required' => "وارد کردن پسورد اجباری است",
        'password.min' => "پسورد باید حداقل 5 کاراکتر باشد",
        'password.max' => "پسورد باید شامل حداکثر 15 کاراکتر باشد",

    ];
    public function register(Request $request){
        $validator = Validator::make($request->toArray(),$this->registerRule, $this->registerMessage);
        if($validator->fails())
            return redirect('signing_form')->withErrors($validator);
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();
        Auth::login($user);
        return redirect('/');
    }
    public function login(Request $request){
        $validator = Validator::make($request->toArray(),$this->loginRules, $this->loginMessages);
        if($validator->fails())
            return redirect('/')->withErrors($validator);

        if(!Auth::attempt($request->only(['email', 'password'])))
            return redirect('/')->withErrors(["پسورد یا ایمیل اشتباه وارد شده است"]);
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function addToBasket(Request $request){
        $productId = $request->product_id;
        $product = product::findOrFail($productId);
        if(basket::whereUserId(Auth::user()->id)->whereProductId($productId)->first())
            return redirect('/')->withErrors(['این محصول در سبد خرید شما وجود دارد']);
        $basket = new basket();
        $basket->user_id = Auth::user()->id;
        $basket->product_id = $product->id;
        $basket->save();
        return redirect('/')->with('success', "محصول به سبد خرید اضافه شد.");
    }
    public function getBaskets(){
        $baskets = basket::whereUserId(Auth::user()->id)->get();
        $products = array();
        foreach($baskets as $basket)
            $products[] = product::find($basket->product_id);
        return response()->json($products, 200);
    }

    public function deleteBasket(Request $request){
        $product_id = $request->only('productId');
        $basket = basket::whereProductId($product_id)->first();
        $basket->delete();
        return response()->json(['message' => "محصول با موفقیت از سبد خرید حذف شد"], 200);
    }
    public function totalPrice(Request $request){
        $product_count = $request->input();
        $price = 0;
        foreach($product_count as $productId => $count)
            $price += product::findOrFail($productId)->price * $count;
        return response()->json(['totalPrice'=>$price, "email" => Auth::user()->email], 200);
    }
    public function payment(){
//        $invoice = new Invoice();
//        $invoice->amount(1000);
//        $invoice->detail(['email' => Auth::user()->email]);
//        $invoice->uuid();
        return Payment::purchase(
            (new Invoice)->amount(1000),
            function($driver, $transactionId) {
                // Store transactionId in database.
                // We need the transactionId to verify payment in the future.
            }
        )->pay()->render();
    }
}
