@extends('layout.app')
@section('title')
بيانات الأقسام
@endsection
@section('content')
<a href="/dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
<table class="stockTable">
        <tr>
            <td class="stockHeader" style="width:50px">المسلسل</td>
            <td class="stockHeader" style="width:150px">الاسم</td>
            <td class="stockHeader" style="width:50px">عدد الأصناف المسجلة</td>
            <td class="stockHeader" style="width:50px">التفاصيل</td>
        </tr>
        @if(count($categories)>0)
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{count($category->products)}}</td>
                    <td><a href="\categories/{{$category->id}}"><i class="fas fa-2x fa-ellipsis-h"></i></a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>0</td>
                <td>لا توجد اقسام </td>
                <td>لا توجد اقسام </td>
                <td><i class="fas fa-2x fa-ellipsis-h"></i></td>
            </tr>
        @endif
</table>
<div class="linkcontainer" style="width:300px;margin:auto">
    {{$categories->links()}}
</div>
@endsection
