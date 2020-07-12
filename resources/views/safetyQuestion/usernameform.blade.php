@extends('layout.outapp')
@section('title')
نسيت كلمة المرور
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-5"></div>
        <div class="col-md-5 col-5">
            <form class="loginCont" method="POST" action="{{route('checkUserName')}}">
                @csrf
                <h3>نسيت كلمة المرور</h3>
                <label>برجاء إدخال اسم المستخدم</label>
                <input  type="text" style='margin: 20px 0 20px;'  placeholder=" اسم المستخدم" name="username" required autocomplete='off' value="{{ old('username') }}">
                <input type="submit" class="btn btn-info"  value="فحص">
            </form>
        </div>
        <div class="col-md-2 col-2"></div>
    </div>
</div>
@endsection
