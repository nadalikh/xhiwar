@extends('admin.layout.master')
@section('content')
    <form method="post" action="{{action('\App\Http\Controllers\adminController@createProduct')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <label for="brand" class="form-label text-white">برند</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="">
        </div>
        <div class="mb-5">
            <label for="name" class="form-label text-white">نام</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="">
        </div>
        <div class="mb-5">
            <label for="country_manufacturer" class="form-label text-white">کشور سازنده</label>
            <input type="text" class="form-control" name="country_manufacturer" id="country_manufacturer" placeholder="">
        </div>
        <div class="mb-5">
            <label for="price" class="form-label text-white">قیمت(ریال)</label>
            <input type="number" class="form-control" name="price" id="price" value="1000">
        </div>
        <div class="form-check form-switch mb-5">
            <input class="form-check-input" name="switch_category" type="checkbox" id="category_switch">
            <label class="form-check-label text-white" for="category_switch">دسته بندی جدید</label>
        </div>
        <select id="category-select" name="category_select" class="form-select mb-5" aria-label="Default select example">
            <option disabled selected hidden value="Choose your preferred number">انتخاب کنید</option>
            @foreach($categories as $cat)
                <option value="{{$cat->name}}">{{$cat->name}}</option>
            @endforeach
        </select>
        <div id="new_category" class="mb-5">
            <label class="form-label text-white">دسته بندی جدید</label>
            <input type="text" name="new_category" placeholder="نام دسته را وارد کنید">
        </div>
        <div class="mb-5">
            <label class="form-label text-white">عکس محصول</label>
            <input type="file" class="form-control" name="image" accept=".png,.jpg,.jpeg,.svg">
        </div>
        <input class="btn btn-primary mx-auto my-3 w-25 d-block" type="submit" value="اضافه کردن محصول">
    </form>
    <script>
        $('#new_category').hide();
        $("#category_switch").click(function(){

            if($("#category_switch")[0].checked == true) {
                $('#category-select').hide();
                $('#new_category').show();
            }else{
                $('#category-select').show();
                $('#new_category').hide();
            }
        });
    </script>
@endsection
