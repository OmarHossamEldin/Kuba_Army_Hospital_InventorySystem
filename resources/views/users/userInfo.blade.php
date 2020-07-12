@extends('layout.app')
@section('title')
    بيانات المستخدمين
@endsection
@section('content')
    <a class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
    <table class="userTable">
        <tr>
            <td class="userHeader" style="width:50px">المسلسل</td>
            <td class="userHeader" style="width:200px">الاسم</td>
            <td class="userHeader" style="width:100px">التصريح</td>
            <td class="userHeader" style="width:100px">الحد الأقصى للخصم</td>
            <td class="userHeader" style="width:100px">التفاصيل</td>
        </tr>
        <tr>
            <td>U-1222</td>
            <td>عمر حسام الدين قنديل</td>
            <td>2</td>
            <td>0</td>
            <td><a href="\userdetails"><i class="fas fa-2x fa-ellipsis-h"></i></a></td>
        </tr>
    </table>
@endsection
