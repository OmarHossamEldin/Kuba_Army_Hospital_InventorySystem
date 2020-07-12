@extends('layout.app')
@section('title')
    تفاصيل المستخدم
@endsection
@section('content')
    <a href="\users" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
    <div class="container userDetailsTable">
        <div class="row">
            <label class="col-md-3 col-5">الاسم :</label>
            <p class="col-md-9 col-7">{{$user->name}}</p>
        </div>
        <div class="row">
            <label class="col-md-3 col-5">اسم المستخدم :</label>
            <p class="col-md-9 col-7">{{$user->username}}</p>
        </div>

        <div class="row">
            <label class="col-md-3 col-5">تصريح :</label>
            <p class="col-md-9 col-7">{{$user->level}}</p>
        </div>
        <div class="row">
            <label class="col-md-3 col-5">الحد الأقصى للخصم :</label>
            <p class="col-md-9 col-7">{{$user->discount}}</p>
        </div>
        <div class="row">
            <label class="col-md-3 col-5">وقت الانشاء :</label>
            <p class="col-md-9 col-7">{{$user->created_at}}</p>
        </div>
    </div>
    <a href="\users/{{$user->id}}/edit" class="btn btn-info infoEdit">تعديل البيانات</a>
    <form action='\users/{{$user->id}}' id='deletefrom' method="post">
        @method('DELETE')
        @csrf
        <button id='delete' class="btn btn-danger deleteUser" type='submit'>حذف المستخدم</button>
    </form>
@endsection
