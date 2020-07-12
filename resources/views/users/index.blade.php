@extends('layout.app')
@section('title')
المستخدمين
@endsection
@section('content')
<a href="/dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
        <table class="employersTable">
        <tr>
            <td class="employersHeader" style="width:50px">المسلسل</td>
            <td class="employersHeader" style="width:200px">الاسم</td>
            <td class="employersHeader" style="width:200px">اسم المستخدم</td>
            <td class="employersHeader" style="width:100px">تصريح</td>
            <td class="employersHeader" style="width:100px">التفاصيل</td>
        </tr>
        @if(count($users)>0)
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->level}}</td>
                <td><a href="/users/{{$user->id}}"><i class="fas fa-2x fa-ellipsis-h"></i></a></td>
            </tr>
            @endforeach
        @else
            <tr>
                <td>0</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td><i class="fas fa-2x fa-ellipsis-h"></i></td>
            </tr>
        @endif
</table>
<div class="linkcontainer" style="width:300px;margin:auto">
    {{$users->links()}}
</div>
@endsection
