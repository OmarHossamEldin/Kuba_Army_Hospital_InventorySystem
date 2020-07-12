@extends('layout.outapp')
@section('title')
اعادة تعيين كلمة المرور
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-5"></div>
        <div class="col-md-5 col-5">
            <form class="loginCont" method="POST" action="{{route('ChangingPassword')}}" dir='rtl'>
                @csrf
                <h3>اعادة تعيين كلمة المرور</h3><br>
                <label for="password">كلمة المرور:</label><br>
                <input id="password" type="password" style='margin: 10px 0 20px;' name="password" required><br>
                <label for="password-confirm">تاكيد كلمةالمرور:</label><br>
                <input id="password-confirm" style='margin: 10px 0 20px;' type="password" name="password_confirmation" required><br>
                <input type="submit" class="btn btn-info"  value="حفظ">
            </form>
        </div>
        <div class="col-md-2 col-2"></div>
    </div>
</div>
@endsection