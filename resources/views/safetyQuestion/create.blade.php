@extends('layout.outapp')
@section('title')
سؤال الامان
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-5"></div>
        <div class="col-md-5 col-5">
            <form class="loginCont" method="POST" action="{{ route('SaftyQuestion.store') }}">
                @csrf
                <h3>سؤال الامان</h3>
                <label  >{{$question[$key]}}</label>
                <input  type="text" style='margin: 20px 0 20px;'  placeholder="برجاء اكتبه الاجابة" name="answer" required autocomplete='off'>
                <input type="submit" class="btn btn-info"  value="اجابة">
                <input type="hidden" name="key" value="{{$key}}">
            </form>
        </div>
        <div class="col-md-2 col-2"></div>
    </div>
</div>
@endsection