@extends('layout.header')
@section('content')
<div class="dark-back">
    <div class="con-con">
        <div class="img-con"></div>
        <div id="signin-con">
            <div class="head-content-s">
                <p>ثبت نام</p>
            </div>
            <form action="{{action('\App\Http\Controllers\userController@register')}}" method="post">
                @csrf
                <div class='wrapper-s'>
                    <label for="e">ایمیل</label>
                    <input type="email" id="e" name='email' placeholder="email: test@test.com">
                </div>
                <div class='wrapper-s'>
                    <label for="n">نام</label>
                    <input type="text" id="n" name='name' placeholder="نام">
                </div>
                <div class='wrapper-s'>
                    <label for="p1">رمز ورود</label>
                    <input type="password" id='p1' name="password" placeholder="******">
                </div>
                <div class='wrapper-s'>
                    <label for="p2">تکرار رمز </label>
                    <input type="password" id='p2' name="password_confirmation" placeholder="******">
                </div>
                <input class='sub' type="submit" id='sub-sign' name='signin' value='ثبت نام' >
{{--                <input class='sub' type="submit" id='sub-reset-pass' name='reset-pass' value='بازیابی رمز عبور' style='display:none;'>--}}

            </form>
        </div>


    </div>
</div>
</body>
</html>
@endsection
