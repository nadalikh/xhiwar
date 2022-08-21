@extends('layout.header')
@section('content')
    <div class="t-form">

        <table id="table">
            <thead  id="head">
            <th>عنوان</th>
            <th>برند</th>
            <th>قیمت</th>
            <th>تعداد</th>
            <th>حذف مورد</th>
            </thead>

        </table>
        <div class="center">
            <button type="button" onclick="cal()">مرحله ی بعد</button>
        </div>
    </div>
    <div class="ticket">
        <div class="group">
            <p>جهت سفارش اطلاعات زیر را کامل کنید</p>
        </div>
        <form action="zarinpal/request.php" method="post">
            <div class="p-info">
                <label for="name">نام و نام خانوادگی&rlm;:</label>
                <input type="text" name="name" id="name" required>
                <label for="email">ایمیل&rlm;:</label>
                <input type="email" name="email" id="email"  readonly="on" required>
            </div>
            <div class="c-info">
                <label for="zipcode">کدپستی&rlm;:</label>
                <input type="text" name="zipcode" id="zipcode" dir="ltr">
                <label for="mobile">شماره همراه&rlm;:</label>
                <input type="text" name="mobile" id="mobile" pattern="(09)[0-9]{9}" placeholder="09*********" style="direction: ltr;" required>
            </div>
            <div class="address">
                <label for="address">آدرس&rlm;:</label>
                <input type="text" name="address" id="address" required>
            </div>
            <div class="check-f">
                <label>قیمت نهایی&rlm;(تومان)</label>
                <input type="text" name="price" id="price" readonly="on" required>
                <input type="submit" name="online_payment" value="پرداخت آنلاین">
            </div>
        </form>
    </div>
    <script>
        startOnBP('{{auth()->user()->email}}');
    </script>
@endsection
