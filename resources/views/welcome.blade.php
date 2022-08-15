<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta name="description" content="شما میتوانید با خرید انلاین کتاب از فروشگاه کتاب امیر،کتاب های نو و دست دوم به صورت انلاین خریداری کنید و در سریع ترین زمان ممکن کتاب را تحویل بگیرید";>
    <meta name="keyword" content="فروشگاه کتاب امیر,خرید انلاین کتاب,کتاب فروشی امیر,خرید انلاین کتاب از کتاب فروشی امیر";>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href='site_images/logo_n.jpeg' type="image/gif" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset("css/ccc.css")}}">
    <title>فروشگاه انلاین ژیوار</title>
</head>
<body class="" id="bod" onload="loaderoff()">
{{--<body class="" id="bod">--}}
<div class="preloader">
    <img src="{{asset("site_images/preloader.gif")}}" style="    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);">
</div>
<nav class="ul" id="my-nav">
    <a class="light" href="index.php"><i class="fa fa-home"></i>خانه</a>
    <a class="light" href="aboutus.html"><i class="fa fa-info-circle"></i>درباره ما</a>
    <a class="light" href="#contac-us"><i class="fa fa-phone-square"></i>ارتباط با ما</a>

    <div class="d-d">
        <p style="font-size:11px; margin:0; padding: 0;">nadalikh@gmail.com</p>

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
        <div class="d-d-c">
                <a href='index.php?cat=$cat'>دسته اول</a>
                <a href='index.php?cat=$cat'>دسته دوم</a>
                <a href='index.php?cat=$cat'>دسته دوم</a>
        </div>
    </div>

    <a class="light" href="buying.php"><i class="fa fa-shopping-cart"></i>سبد خرید  <div  style="display:inline-block; position:relative; border-radius: 50%;   border: 1px solid red; padding:0 3px; width:15px; height:15px; "> <p id="book-counter">5</p> </div></a>

    <a class="icon" href="javascript:void(0);" style="font-size:15px;"  onclick="myFunction()">&#9776;</a>


    <form id="search" action="index.php" method="post">
        <input type="text" placeholder="جست و جوی سریع" name="content">
        <button type="submit" name="fast-search"><img src="https://img.icons8.com/color/30/000000/search.png"/></button>
    </form>
    <img class='logou' src="{{asset("site_images/logo.png")}}" alt="" loading='lazy'>
</nav>
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
            <form class="form" action="" method="post">
                <div class="wrapper">
                    <label for="e">برند &rlm;:</label>
                    <input type="text" name="publisher" id="e" required >
                </div>
                <div class="wrapper">
                    <label for="n">کشور سازنده&rlm;:</label>
                    <input type="text" name="author" id="n" required>
                </div>
                <div class="wrapper">
                    <label for="m">عنوان محصول&rlm;:</label>
                    <input type="text" name="title" id="m" required>
                </div>
                <input name='exact_search' class="sub" type="submit" value="جستوجو">
            </form>
        </div>
        <div class='fast-signin'>
            <div class="head-content">
                <p>ثبت نام سریع</p>
            </div>
            <form action="signin.php" method='post' class='wrapper'>
                <label for="fast-signin">ایمیل&rlm;:</label>
                <input id="fast-signin" name="f-s-e" type="email" placeholder="email: test@test.com">
                <button type="submit" name='f-s'>ثبت نام</button>
            </form>
        </div>
    </div>
    <main>
        <div class="book" id="">
            <div class="innerbook">
                <div class="front">
                    <img src="{{asset("images/p1.jpg")}}" alt="" loading='lazy'>
                </div>
                <div class="back">
                    <p>عنوان&rlm;:</p>
                    <p>برند&rlm;:</p>
                    <p>کشور سازنده&rlm;:</p>
                    <p>عنوان محصول&rlm;:</p>
                    <a href='{{route("product", "38848")}}'><i class="fa fa-eye"></i>مشاهده محصول</a>
                </div>
            </div>
        </div>
        <div class="book" id="">
            <div class="innerbook">
                <div class="front">
                    <img src="{{asset("images/p2.jpg")}}" alt="" loading='lazy'>
                </div>
                <div class="back">
                    <p>عنوان&rlm;:</p>
                    <p>برند&rlm;:</p>
                    <p>کشور سازنده&rlm;:</p>
                    <p>عنوان محصول&rlm;:</p>
                    <a href='{{route("product", "s3232")}}'><i class="fa fa-eye"></i>مشاهده محصول</a>
                </div>
            </div>
        </div>
{{--        <div class="product" id="">--}}
{{--            <div class="innerbook">--}}
{{--                <div class="front">--}}
{{--                    <img src="" alt="" loading='lazy'>--}}
{{--                    <h3>عنوان</h3>--}}
{{--                    <p></p>--}}
{{--                </div>--}}
{{--                <div class="back">--}}
{{--                    <p>عنوان&rlm;:<?=?>--}}
{{--                    <p>کدشابک&rlm;:<?=  ?></p>--}}
{{--                    <p>نویسندگان&rlm;:</p>--}}
{{--                    <p>انتشارات&rlm;:</p>--}}
{{--                    <p>قیمت&rlm;:<span style="color:red;"></span>تومان  </p>--}}
{{--                    <p>سال انتشار&rlm;:<span style="color:red;"><?= (strval/*($rows['publish_year'])*/($value->publish_year)) ?></span></p>--}}
{{--                    <a href='./product.php?isbn='><i class="fa fa-eye"></i>مشاهده کتاب</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

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
<div id="popup">
    <form id="login" action="login.php" method="post">
        <button id="esc" type="button" onclick="close_form()"><i class="fa fa-close"></i></button>
        <div class="l-col">
            <label for="le">ایمیل&rlm;:</label>
            <input type="email" id="le" name="l-email" placeholder="test@test.com">
        </div>
        <div class="l-col">
            <label for="pe">رمز&rlm;:</label>
            <input type="password" id="pe" name="l-password">
        </div>
        <input type="submit" name="l-submit" value="ورود">
        <input  type="submit" name="logout" value="خروج از حساب کاربری" >
        <a href='signin.php?forgot=true'>رمزم را فراموش کردم</a>
    </form>
</div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('js/scripts.js')}}"></script>

</body>
</html>

