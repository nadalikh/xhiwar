@extends('admin.layout.master')
@section('content')
    <form method="post" action="{{action('\App\Http\Controllers\adminController@createProduct')}}">
        @csrf
        <div class="mb-3">
            <label for="brand" class="form-label text-white">برند</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label text-white">عنوان محصول</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label text-white">نام</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label text-white">قیمت(ریال)</label>
            <input type="number" class="form-control" name="price" id="price" value="1000">
        </div>
        <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            @foreach($categories as $cat)
                <option value="{{$cat->name}}">{{$cat->name}}</option>
            @endforeach
        </select>
        <input class="btn btn-primary mx-auto my-3 w-25 d-block" type="submit" value="add product">
    </form>
@endsection
