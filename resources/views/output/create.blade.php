@extends('layout.app')
@section('title')
إضافة فاتورة صرف
@endsection
@section('script')
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/output.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/myselect2.css')}}">
@endsection
@section('content')
<a href="\dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>
<div class="salesInput">
        @csrf
        @if(count($lastOutput)>0)
            <input type="text" id='id' value='{{$lastOutput[0]->id+1}}' readonly placeholder="الرقم المسلسل للإدخال">
        @else
            <input type="text" id='id' value='{{1}}' readonly placeholder="الرقم المسلسل للإدخال">
        @endif
        <input type="text" class='place vertical' name='place' placeholder="مكان التوريد"><br>
        <textarea id='notes' class="vertical" placeholder="ملاحظات"></textarea>
        <hr>
        <select class='itemname myselect2 vertical' >
            @if(count($Products)>0)
                <option></option>
                @foreach($Products as $Product)
                    <option value='{{$Product->id}}'>{{$Product->name}}</option>
                @endforeach
            @else
                <option>لم يتم اضافه اي اصناف</option>
            @endif
        </select>
        <input type="number" class='itembarcode vertical' placeholder="باركود الصنف"><br>
        <input type="number" min='0' class='itemmount vertical' placeholder=" الكمية">
        <label class="quantity">
        </label><br>
        <input type="submit" class="btn btn-info addtobill vertical" value="إضافة التوريد">
        </div>
    <hr>
    <table class="salesTable">
        <thead>
            <tr>
                <td class="salesHeader" style="width:50px">المسلسل</td>
                <td class="salesHeader" style="width:200px">الصنف</td>
                <td class="salesHeader" style="width:50px">الكمية</td>
                <td class="salesHeader" style="width:100px">حذف</td>
            </tr>
        </thead>
        <tbody class="bills_rows">
            <tr>
                <td>0</td>
                <td></td>
                <td></td>
                <td><i class="far fa-2x fa-trash-alt"></i></td>
            </tr>
        </tbody>
    </table>

    <a href="/dashboard" class="btn btn-danger cancleBill">إلغاء التوريد</a>
    <input type="submit" class="btn btn-info printBill vertical" value="تسجيل التوريد">
@endsection
