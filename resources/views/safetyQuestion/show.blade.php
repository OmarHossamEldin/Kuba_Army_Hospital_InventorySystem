@extends('layout.outapp')
@section('title')
سؤال الامان
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-5"></div>
        <div class="col-md-5 col-5">
            <form class="loginCont" method="POST" action="\answer/{{$User->id}}">
                @csrf
                <h3>سؤال الامان</h3>
                <label  >{{$question}}</label>
                <input  type="text" style='margin: 20px 0 20px;'  placeholder=" الاجابة" name="answer" required autocomplete='off'>
                <input type="submit" class="btn btn-info"  value="اجابة">
            </form>
        </div>
        <div class="col-md-2 col-2"></div>
    </div>
</div>
@endsection