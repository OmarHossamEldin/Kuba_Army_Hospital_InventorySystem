@extends('layout.app')
@section('title')
إضافة قسم جديد
@endsection
@section('content')
<a href="\dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>

        <form class="addDepartment" method="POST" action='\categories'>
            @csrf
            <label>اسم القسم :</label>
            <input type="text" class="productName" name="Catename" placeholder="اسم القسم"><br>
            <input class="btn btn-info" type="submit" value="تسجيل القسم">
        </form>
@endsection
