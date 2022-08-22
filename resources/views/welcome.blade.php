@extends('layout.header')
@section('content')
<img class="h-image" src="{{asset("site_images/header.jpg")}}" alt="" loading='lazy'>
<header>
    <div class="readable">
        <h1>فروشگاه لوازم مراقبت های پوستی</h1>
        <h2>خرید انلاین انواع ماسک و لوام محافظ پوستی</h2>
        <h3>از خانه با ارامش خرید کنید</h3>
    </div>

    <div id="pro-counter">
        <div class="counter">
            <div class='centerall'>
                <p>1</p>
            </div>
        </div>
        <span>تعداد محصولات</span>
    </div>
    <div id="user-counter">
        <div class="counter">
            <div class="centerall">
                <p>1</p>
            </div>
        </div>
        <span>تعداد كاربران</span>
    </div>
    <div id="sold-counter">
        <div class="counter">
            <div class="centerall">
                <p>0</p>
            </div>
        </div>
        <span>محصولات فروخته شده</span>
    </div>
    <div id="order-counter">
        <div class="counter">
            <div class="centerall">
                <p>1</p>
            </div>
        </div>
        <span>سفارشات ثبت شده</span>
    </div>

</header>
<div class="container">
    <div class="contain">
        <div id="exact-search">
            <div class="head-content">
                <p>جستو جوی دقیق</p>
            </div>
            <p>تمام فیلدها را پر کنید</p>
            <form class="form" action="{{action('\App\Http\Controllers\routeController@exactSearch')}}" method="get">
                <div class="wrapper">
                    <label for="e">برند &rlm;:</label>
                    <input type="text" name="brand" id="e" required >
                </div>
                <div class="wrapper">
                    <label for="n">کشور سازنده&rlm;:</label>
                    <input type="text" name="country_manufacturer" id="n" required>
                </div>
                <div class="wrapper">
                    <label for="m">عنوان محصول&rlm;:</label>
                    <input type="text" name="name" id="m" required>
                </div>
                <input name='exact_search' class="sub" type="submit" value="جستوجو">
            </form>
        </div>
        <div class='fast-signin'>
            <div class="head-content">
                <p>ثبت نام سریع</p>
            </div>
            <form action="{{action('\App\Http\Controllers\routeController@signing_form')}}" method='get' class='wrapper'>
                <label for="fast-signin">ایمیل&rlm;:</label>
                <input id="fast-signin" name="email" type="email" placeholder="email: test@test.com">
                <button type="submit" >ثبت نام</button>
            </form>
        </div>
    </div>
    <main>
        @foreach($products as $product)
            <div class="book" id="">
                <div class="innerbook">
                    <div class="front">
                        <img src="{{asset("images/$product->path")}}" alt="" loading='lazy'>
                    </div>
                    <div class="back">
                        <p>برند&rlm;:{{$product->brand}}</p>
                        <p>کشور سازنده&rlm;:{{$product->country_manufacturer}}</p>
                        <p>عنوان محصول&rlm;:{{$product->name}}</p>
                        <p>قیمت&rlm;:<span style='color:red;'>{{$product->price}}</span>تومان </p>
                        <a href='{{route("product", $product->id)}}'><i class="fa fa-eye"></i>مشاهده محصول</a>
                    </div>
                </div>
            </div>
        @endforeach

    </main>
</div>


<footer id="contac-us">
    <div class="info">
        <p data-aos="fade-down" data-aos-delay="500"  ><img src="https://img.icons8.com/fluent/25/000000/address.png"/>تهراننننننننننننننننننننننننننننننننننننننننننننننننننننن</p>
        <p data-aos-delay="1200" data-aos="zoom-in" data-aos-anchor-placement="right-left"> <img src="https://img.icons8.com/fluent/20/000000/telegram-app.png"/><a target="_blank" href="https://t.me/nadali619">تلگرام</a></p>
        <p data-aos-delay="1500" data-aos="zoom-in"> <img src="https://img.icons8.com/fluent/20/000000/gmail.png"/><a target="_blank" href="mailto: amir.book09@gmail.com">ایمیل پشتیبانی</a></p>
        <p data-aos-delay="2000" data-aos="zoom-in"> <img src="https://img.icons8.com/fluent/25/000000/instagram-new.png"/><a target="_blank" href="">اینستاگرام</a></p>
        <p data-aos-delay="2500" data-aos="zoom-in"> <img src="https://img.icons8.com/color/20/000000/phone.png"/>021-66000</p>
        <p>با  ما درارتباط باشید</p>
    </div>
    <style>#zarinpal{margin:auto} #zarinpal img {width: 80px;}</style>
    <div id="zarinpal">
        <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d405.0041386492729!2d51.39604428266115!3d35.70080284477943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e01a5c6f3fb25%3A0x459372a07856fff5!2z2YHYsdmI2LTar9in2Ycg2qnYqtin2Kgg2KfZhtiv24zYtNmH!5e0!3m2!1sen!2suk!4v1596450892921!5m2!1sen!2suk"   frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
    </iframe>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

@endsection
