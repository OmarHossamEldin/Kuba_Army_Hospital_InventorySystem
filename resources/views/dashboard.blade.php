@extends('layout.app')
@section('title')
لوحة التحكم
@endsection
@section('content')
<label class="welcomeMsg">مرحباً بك <form><span>{{Auth::user()->name}}</span></form></label>
<div class="row">
    <table class="stockTable">
        <thead>
            <tr>
                <td class="stockHeader" style="width:50px">المسلسل</td>
                <td class="stockHeader" style="width:150px">اسم الصنف</td>
                <td class="stockHeader" style="width:50px">رصيد الصنف</td>
                <td class="stockHeader" style="width:50px">الوصف</td>
            </tr>
        </thead>
        <tbody class="searchresult">
        @if(count($stockLimits)>0)   
            @foreach($stockLimits as $stockLimit)
            <tr>
                <td>{{$stockLimit['id']}}</td>
                <td>{{$stockLimit['name']}}</td>
                <td>{{$stockLimit['quantity']}}</td>
                <td>لقد تم الوصول الي الحد الاقصي لهذا الصنف</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td>0</td>
                <td>لا توجد اصناف قيد النفاذ</td>
                <td>لا توجد اصناف قيد النفاذ</td>
                <td >لا توجد اصناف قيد النفاذ</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection


