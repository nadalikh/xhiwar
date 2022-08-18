<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        return redirect('root');
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
}
