@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('message',"شما به این صفحه دسترسی ندارید.لطفا به حساب کاربری وارد شوید")
@section('link', route('root'))
