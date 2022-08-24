<?php

namespace App\Http\Controllers;

use App\Models\basket;
use App\Models\order;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Larabookir\Gateway\Gateway;

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
        foreach($baskets as $basket) {
            $product = product::find($basket->product_id);
            $product->number = $basket->number;
            $products[] = $product;
        }
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
        foreach($product_count as $productId => $count) {
            $price += product::findOrFail($productId)->price * $count;
            $basket = basket::whereUserId(Auth::user()->id)->whereProductId($productId)->first();
            $basket->number = $count;
            $basket->update();
        }
        return response()->json(['totalPrice'=>$price, "email" => Auth::user()->email], 200);
    }
    public function payment(Request $request){
        try {
            $content = $request->validate([
                'price' =>'required|numeric',
                'mobile' => 'required|digits:11',
                'address' => 'required|max:40',
                'name' => 'required|max:40'
            ]);
            $gateway = Gateway::make('zarinpal');

            $gateway->setCallback(url('/callback')); // You can also change the callback
            $gateway->price($content['price']*10)
                // setShipmentPrice(10) // optional - just for paypal
                // setProductName("My Product") // optional - just for paypal
                ->ready();
            $refId =  $gateway->refId(); // شماره ارجاع بانک
            $transID = $gateway->transactionId(); // شماره تراکنش

            // در اینجا
            //  شماره تراکنش  بانک را با توجه به نوع ساختار دیتابیس تان
            //  در جداول مورد نیاز و بسته به نیاز سیستم تان
            // ذخیره کنید .


            $baskets = basket::whereUserId(Auth::user()->id)->get();
            $products = array();
            foreach($baskets as $basket)
                $products[] = product::find($basket->product_id);

            $order = new order();
            $order->price = $content['price'];
            $order->ref_id = $refId;
            $order->transaction_id = $transID;
            $order->user_id = Auth::user()->id;
            $order->address = $content['address'];
            $order->mobile = $content['mobile'];
            $order->name = $content['name'];
            $order->save();
            foreach ($products as $product) {
                $basket = basket::whereUserId(Auth::user()->id)->whereProductId($product->id)->first();
                $order->products()->attach($product, ['number' => $basket->number]);
            }
            return $gateway->redirect();

        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

}
