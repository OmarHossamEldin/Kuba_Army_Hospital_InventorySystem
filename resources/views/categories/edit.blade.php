@extends('layout.app')
@section('title')
تعديل علي قسم {{$category->name}}
@endsection
@section('content')
<a href="\categories" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>
            <form class="addDepartment" method="POST" action='\categories/{{$category->id}}'>
            @csrf
            @method('PATCH')
            <label>اسم القسم :</label>
            <input type="text" class="productName" name="name" value="{{$category->name}}" placeholder="اسم القسم"><br>
            <input class="btn btn-info" type="submit" value="تعديل القسم">
        </form>
@endsection
