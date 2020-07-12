@extends('layout.app')
@section('title')
إضافة صنف جديد
@endsection
@section('script')
<script src="{{asset('js/printbarcode.js')}}"></script>
@endsection
@section('content')
<a href="\products" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>
        <form class="addProduct" method="POST" action='\products'>
            @csrf
            <label>الرمز الشريطي (الباركود) :</label>
            @if(isset($barcode))
                <input type="text" class="barcode" value="{{$barcode}}" name="id" readonly>
                <br>
            @else
                <input type="text" value="برجاء اعادة تحميل الصفحه للحصول علي الرمز الشريطي جديد" name="barcode" readonly><br>
            @endif
            <label>اسم الصنف :</label>
            <input type="text" class="productName" name="name" placeholder="اسم الأصناف"><br>
            <label>الحد الادني :</label>
            <input type="number" name="limit" placeholder="وحدات" required><br>
            <label>القسم :</label>
            <select name='category' class="department">
                    @if(count($categories)>0)
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @else
                        <option>لم يتم إضافة اي اقسام بعد</option>
                    @endif
            </select><br>
            <label>ملاحظات :</label>
            <textarea name='notes' placeholder="ملاحظات"></textarea><br>
            <input class="btn btn-info" type="submit" value="تسجيل الصنف">
        </form>
@endsection
