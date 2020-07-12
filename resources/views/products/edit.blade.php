@extends('layout.app')
@section('title')
تعديل الصنف {{$product->name}}
@endsection
@section('script')
<script src="{{asset('js/editproduct.js')}}"></script>
@endsection
@section('content')
        <a href="\products" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>
        <form class="editProduct" method="POST" action="\products/{{$product->id}}">
            @csrf
            @method('PATCH')
            <label>الرمز الشريطي (الباركود) :</label>
            <input type="text" class="barcode" value="{{$product->id}}" name="barcode" readonly><br>
            <label>اسم الصنف :</label>
            <input type="text"  value="{{$product->name}}" class="productName" name="name" readonly><br>

            <label>الحد الادني :</label>
            <input type="number" name="limit" value='{{$product->limit}}' placeholder="وحدات"><br>
            <label>القسم :</label>
            <select name='category' selectedoption='{{$product->category_id}}' class="department category">
                    <option disable></option>
                    @if(count($categories)>0)
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @else
                        <option>حدث خطاء</option>
                    @endif
            </select><br>
            <label>الكمية :</label>
            <input type="number" min='0'  readonly name="Quantity" value='{{$product->stock->quantity}}' placeholder="كمية"><br>
            <label>ملاحظات :</label>
            <textarea name='notes' placeholder="ملاحظات">{{$product->notes}}</textarea><br>
            <input class="btn btn-info" type="submit" value="تعديل بيانات الصنف">
        </form>
@endsection
