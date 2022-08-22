@extends('layout.header')
@section('content')
    <div class='product'>
        <img src="{{asset('images/'.$product->path)}}">
        <p>برند&rlm;:{{$product->brand}}</p>
        <p>کشور سازنده&rlm;:{{$product->country_manufacturer}}</p>
        <p>عنوان محصول&rlm;:{{$product->name}}</p>
        <p>قیمت&rlm;:<span style='color:red;'>{{$product->price}}</span>تومان </p>
        <form method="post" action="{{action('\App\Http\Controllers\userController@addToBasket')}}">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <button type="submit" ><i class="fa fa-shopping-cart"></i><P>افزودن به سبد خرید</P></button>
        </form>
           <a href='{{route('category', $category->id)}}'>#{{$category->name}}</a>
    </div>
@endsection
