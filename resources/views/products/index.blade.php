@extends('layout.app')
@section('title')
المخزن
@endsection
@section('script')
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/stock.js')}}"></script>
@endsection
@section('content')
<a href="/dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
@if(Auth::user()->level==1)
    <div class="salaryHistory">
            @csrf
            <label>تحديد الأصناف :</label>
            <input  class='empname itemsearcher vertical' type="text" placeholder="إدخال تسلسل او اسم الصنف">
            <button type="submit" class="col-3 btn btn-info empsearch selection vertical">بحث</button>
    </div>
@endif
@if(Auth::user()->level==1)
    <div class="salaryHistory">
        <label>مجموع الأصناف:</label>
        <label>{{count($products)}}</label><br>
        <label>مجموع العهدة:</label>
        <label>{{$Total}}</label><br>
    </div>
@endif
<table class="stockTable">
    <thead>
        <tr>
            <td class="stockHeader" style="width:50px">المسلسل</td>
            <td class="stockHeader" style="width:150px">اسم الصنف</td>
            <td class="stockHeader" style="width:100px">القسم</td>
            <td class="stockHeader" style="width:50px">العدد الكلي</td>
            @if(Auth::user()->level==1)
                <td class="stockHeader" style="width:50px">التفاصيل</td>
            @endif
        </tr>
    </thead>
    <tbody class="searchresult">
        @if(count($products)>0)
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->stock->quantity}}</td>
                    @if(Auth::user()->level==1)
                        <td><a href="\products/{{$product->id}}"><i class="fas fa-2x fa-ellipsis-h"></i></a></td>
                    @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td>0</td>
                <td>لاتوجد اصناف مدخلة </td>
                <td>لاتوجد اصناف مدخلة </td>
                <td>لاتوجد اصناف مدخلة </td>
                <td><i class="fas fa-2x fa-ellipsis-h"></i></td>
            </tr>
        @endif
    </tbody>
</table>
<div class="linkcontainer" style="width:300px;margin:auto">
    {{$products->links()}}
</div>
@endsection
