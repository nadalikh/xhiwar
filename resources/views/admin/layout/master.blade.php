<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="{{asset("css/adminStyle.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src='{{asset('js/adminScript.js')}}'></script>

    <title>پنل مدیریت</title>
</head>
<body style="height: 100vh">
<div class="ms-container w-100 h-100">
    <nav>
        <a href='{{route("admin.root")}}'>مدیریت</a>
        <a href="{{route('admin.addProduct')}}">اضافه کردن محصول</a>
        <a href="{{route('admin.manageUser')}}">مدیریت کاربران</a>

    </nav>
    <main id='main'>
        <header>
            <h3>به پنل مدیریت خوش آمدید</h3>
            <h5>منوی سمت راست هر امکانی را برای مدیریت آسان فروشگاه در اختیار شما قرارمیدهد</h5>
        </header>

@yield('content')
    </main>
</div>
@if($errors->any())
    <script>swal("عملیات ناموفق ", "{{$errors->first()}}", "error")</script>
@endif

@if(Session::has('success'))
    <script>swal("عملیات موفق", "{{Session::get('success')}}", "success")</script>
@endif
</body>
</html>
