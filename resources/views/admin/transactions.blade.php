@extends('admin.layout.master')
@section('content')
    <table id="table">
        <thead id="head">
        <th>نام</th>
        <th>موبایل</th>
        <th>ادرس</th>
        <th>کد پیگیری</th>
        <th>وضعیت سفارش</th>
        </thead>
        @foreach($orders as $order)
            <tbody>
            <td>{{$order->name}}</td>
            <td>{{$order->mobile}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->tracking_code}}</td>
            <td>{{$order->message}}</td>
            </tbody>
    @endforeach
@endsection
