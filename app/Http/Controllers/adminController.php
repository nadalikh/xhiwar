<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    private array $createProductRules = [
        'brand' => 'required|max:30',
        'name' => 'required|max:40',
        'country_manufacturer' => 'required|max:40',
        'price' => 'required|numeric',
        'image' => 'required|mimes:jpeg,png,jpg,svg|max:600'
    ];
    private array $createProductMessages = [
        'brand.required' => 'وارد کردن برند اجباری است',
        'brand.max' => 'حداکثر 30 کاراکتر میتوانید برای برند وارد کنید',
        'name.required' => 'وارد کردن نام اجباری است',
        'name.max' => 'حداکثر40 کاراکتر میتوانید برای نام وارد کنید',
        'country_manufacturer.required' => 'وارد کردن کشور سازنده اجباری است',
        'country_manufacturer.max' => 'حداکثر40 کاراکتر میتوانید برای کشور سازنده وارد کنید',
        'price.required' => 'وارد کردن قیمت اجباری است',
        'price.numeric' => 'قیمت باید عدد باشد',
        'image.required' => 'عکس باید وارد شود',
        'image.mimes' => 'عکس ها باید در فرمت های jpeg,png,jpg,svg باشند.',
        'image.max' => 'حداکثر سایز عکس باید 600KB باشد',
    ];
    public function createProduct(Request $request){
        $validator = Validator::make($request->toArray(),$this->createProductRules, $this->createProductMessages);
        if($validator->fails())
            return redirect('admin/addProduct')->withErrors($validator);
        if( (!$request->switch_category && !$request->category_select) || ($request->switch_category == "on" && empty($request->new_category)))
            return redirect('admin/addProduct')->withErrors(["دسته مناسب را وارد یا انتخاب کنید"]);
        $product = new product();
        $categoryName = ($request->switch_category == 'on') ? $request->new_category : $request->category_select;

        try {
            $category = category::whereName($categoryName)->firstOrFail();
        }catch (\Exception $e) {
            $category = category::create(['name' => $categoryName]);
        }
        $product->save();
        if($request->file('image')){
            $file = $request->file('image');
            $filename = $product->id . '.' .$file->extension();
            $file->move(public_path('images'), $filename);
            $product->path = $filename;
        }
        $product->brand = $request->brand;
        $product->name = $request->name;
        $product->country_manufacturer = $request->country_manufacturer;
        $product->price = $request->price;
        $product->category()->associate($category)->save();
        return redirect('/admin/addProduct')->with('success', "اطلاعات محصول با موفقیت ثبت شد");
    }
    public function changeRole(Request $request){
        $userid = $request->only('userId');
        $user = User::find($userid)->first();
        $user->role = ($user->role == "admin") ? "customer" : "admin";
        $user->update();
    }
}
