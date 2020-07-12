@extends('layout.app')
@section('title')
التعديل علي بيانات المستخدم 
@endsection
@section('content')
<a href="/users" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>
            <form class="addProduct" method="POST" action="\users/{{$user->id}}">
                        @csrf
                        @method('PUT')
                        <label for="id" >التسلسل:</label>
                        <input id="id" type="text"  name="id" value="{{$user->id}}" required readonly><br>
                        <label for="name" >الاسم:</label>
                        <input id="name" type="text"  name="name" value="{{$user->name}}" required autofocus><br>
                        <label for="username">اسم المستخدم:</label>
                        <input id="username" type="text"  name="username" value="{{$user->username}}" required><br>
                        <label for="password">كلمة المرور:</label>
                        <input id="password" type="text"  name="password" required><br>
                        <label for="password-confirm">تاكيد كلمة المرور:</label>  
                        <input id="password-confirm" type="text" name="password_confirmation" required><br>
                        <label for="level">تصريح:</label>
                        <select name="level">
                            <option value="{{$user->level}}">{{$user->level}}</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select><br>
                        <input type="submit" class="btn btn-info"  value="تعديل المستخدم">
            </form>
@endsection