@extends('layout.app')
@section('title')
تفصيل الصنف {{$product->name}}
@endsection
@section('content')
<a href="\products" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
<div class="container productTable">
    <div class="row">
        <label class="col-md-3 col-5">اسم الصنف :</label>
        <p id='name' class="col-md-9 col-7">{{$product->name}}</p>
    </div>
    <div class="row">
            <label class="col-md-3 col-5">القسم :</label>
            <p id='name' class="col-md-9 col-7">{{$product->category->name}}</p>
    </div>
    <div class="row">
        <label class="col-md-3 col-5">الرمز الشريطي (الباركود) :</label>
        <p id='barcode' class="col-md-9 col-7">{{$product->id}}</p>
    </div>
    <div class="row">
        <label class="col-md-3 col-5">الكمية :</label>
        <p class="col-md-9 col-7">{{$product->stock->quantity}}</p>
    </div>
    <div class="row">
        <label class="col-md-3 col-5">الملاحظات :</label>
        <p class="col-md-9 col-7">{{$product->notes}}</p>
    </div>
    <div class="row">
        <label class="col-md-3 col-5">تاريخ التسجيل :</label>
        <p class="col-md-9 col-7">{{$product->created_at}}</p>
    </div>
</div>
<a href="\products/{{$product->id}}/edit" class="btn btn-info infoEdit">تعديل البيانات</a>

@endsection
