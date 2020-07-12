@extends('layout.outapp')
@section('title')
تسجيل الدخول
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-5"></div>
        <div class="col-md-5 col-5">
            <form class="loginCont" method="POST" action="{{ route('signin') }}">
                @csrf
                <h3>تسجيل الدخول</h3>
                <input type="text" name='username' class="{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="اسم المستخدم" required autocomplete='off' autofocus value="{{ old('username') }}">
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
                <input  id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="كلمة المرور" name="password" required autocomplete='off'>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <input type="submit" class="btn btn-info" name="Login" value="تسجيل الدخول"><br><br>
                <a href='{{route("checkUserName")}}'>لقد نسيت كلمة المرور</a>
            </form>
        </div>
        <div class="col-md-2 col-2"></div>
    </div>
</div>
@endsection