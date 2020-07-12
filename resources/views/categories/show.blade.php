@extends('layout.app')
@section('title')
تفصيل  {{$category->name}}
@endsection
@section('content')
<a href="\categories" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
                    <div class="container customerTable">
                        <div class="row">
                            <label class="col-md-3 col-5">الاسم :</label>
                            <p class="col-md-9 col-7">{{$category->name}}</p>
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-5">تاريخ الانشاء :</label>
                            <p class="col-md-9 col-7">{{$category->created_at}}</p>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-5">تاريخ التعديل :</label>
                            <p class="col-md-9 col-7">{{$category->updated_at}}</p>
                        </div>
                    </div>
                    <a href="/categories/{{$category->id}}/edit" class="btn btn-info infoEdit">تعديل البيانات</a>
                    <form  method='POST' id='deletefrom' action="\categories/{{$category->id}}">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger deleteEmployer" id='delete'  type="submit">حذف القسم</button>
                    </form>
@endsection
