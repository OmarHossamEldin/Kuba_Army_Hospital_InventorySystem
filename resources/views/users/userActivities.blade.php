@extends('layout.app')
@section('title')
    نشطاط المستخدمين
@endsection
@section('script')
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/useractivites.js')}}"></script>
@endsection
@section('content')
    <a href="/dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
    <div class="userActivitiesInput">
        <label>اسم المستخدم :</label>
        <input type="text" class="username" placeholder="اسم المستخدم"><br>
        <label>المدة :</label>
        <input type="text" class="dateText1" id="dom-id" placeholder="التاريخ من">
        <input type="text" class="dateText2" id="dom-id" placeholder="التاريخ الى"><br>
        <button  class="btn btn-info show">عرض</button>
    </div>
    <table class="userActivitiesCont">
        <tr>
        </tr>

    </table>
@endsection
