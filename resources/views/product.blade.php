@extends('layout.header')
@section('content')
    <div class='product'>
        <img src="{{asset('images/'.$product->path)}}">
        <p>برند&rlm;:{{$product->brand}}</p>
        <p>کشور سازنده&rlm;:{{$product->country_manufacturer}}</p>
        <p>عنوان محصول&rlm;:{{$product->name}}</p>
        <p>قیمت&rlm;:<span style='color:red;'>{{$product->price}}</span>تومان </p>
        <form>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="submit" value="اضافه کردن به سبد خرید"><i class="fa fa-shopping-cart"></i><P>افزودن به سبد خرید</P></input>
        </form>
           <a href=''>#{{$categoryName}}</a>
    </div>
@endsection
