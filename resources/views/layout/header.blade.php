<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href='site_images/logo_n.jpeg' type="image/gif" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="{{asset('js/scripts.js')}}"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link type="text/css" rel="stylesheet" href="{{asset("css/ccc.css")}}">
    <title>فروشگاه انلاین ژیوار</title>
</head>
<body class="" id="bod" onload="loaderoff()">

<div class="preloader">
    <img src="{{asset("site_images/preloader.gif")}}" style="    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);">
</div>
<nav class="ul" id="my-nav">
    <a class="light" href="{{route('root')}}"><i class="fa fa-home"></i>خانه</a>
    @if(auth()->check())
        @if(auth()->user()->role == "admin")
            <a class="light" href="{{route('admin.root')}}"><i class="fa fa-home"></i>پنل ادمین</a>
        @endif
    @endif
    <a class="light" href="aboutus.html"><i class="fa fa-info-circle"></i>درباره ما</a>
    <a class="light" href="#contac-us"><i class="fa fa-phone-square"></i>ارتباط با ما</a>

    <div class="d-d">
        @if(auth()->check())
            <p style="font-size:11px; margin:0; padding: 0;">{{auth()->user()->email}}</p>
        @endif
        <button class="d-d-b"> <i style="font-size: 20px;" class="fa fa-user"></i></button>
        <i class="fa fa-angle-down"></i>
        <div class="d-d-c">
            <a href="#login" onclick="open_form()">ورود/خروج</a>
            <a href="{{route('signing_form')}}">ثبت نام</a>
            <a href="{{route('orders', "sdfsd")}}">سفارش های من</a>
        </div>
    </div>


    <div class="d-d">
        <button class="d-d-b"><i style='padding:5px;' class="fa fa-book"></i>دسته بندی</button>
        <i class="fa fa-angle-down"></i>
        <div class="d-d-c" style="bottom: -{{sizeof($categories) * 48}}px">
            @foreach($categories as $cat)
                <a href=''>{{$cat->name}}</a>
            @endforeach
        </div>
    </div>

    <a class="light" href="{{route('baskets')}}"><i class="fa fa-shopping-cart"></i>سبد خرید
        @if(auth()->check())
            <div  style="display:inline-block; position:relative; border-radius: 50%;   border: 1px solid red; padding:0 3px; width:15px; height:15px; "> <p id="book-counter">{{$basketCount}}</p> </div>
        @endif
    </a>

    <a class="icon" href="javascript:void(0);" style="font-size:15px;"  onclick="myFunction()">&#9776;</a>


    <form id="search" action="index.php" method="post">
        <input type="text" placeholder="جست و جوی سریع" name="content">
        <button type="submit" name="fast-search"><img src="https://img.icons8.com/color/30/000000/search.png"/></button>
    </form>
    <img class='logou' src="{{asset("site_images/logo.png")}}" alt="" loading='lazy'>
</nav>
@yield('content')
<div id="popup">
    <form id="login" action="{{action("\App\Http\Controllers\userController@login")}}" method="post">
        @csrf
        <button id="esc" type="button" onclick="close_form()"><i class="fa fa-close"></i></button>
        <div class="l-col">
            <label for="le">ایمیل&rlm;:</label>
            <input type="email" id="le" name="email" placeholder="test@test.com">
        </div>
        <div class="l-col">
            <label for="pe">رمز&rlm;:</label>
            <input type="password" id="pe" name="password">
        </div>
        <input type="submit" name="l-submit" value="ورود">
        @if(auth()->check())
            <a href="{{route('logout')}}">خروج از حساب کاربری</a>
        @endif
        {{--        <a href='signin.php?forgot=true'>رمزم را فراموش کردم</a>--}}
    </form>
</div>
@if($errors->any())
    <script>swal("عملیات ناموفق ", "{{$errors->first()}}", "error")</script>
@endif
{{--@if(isset($success))--}}
@if(Session::has('success'))
    <script>swal("عملیات موفق", "{{Session::get('success')}}", "success")</script>
@endif
</body>
</html>
