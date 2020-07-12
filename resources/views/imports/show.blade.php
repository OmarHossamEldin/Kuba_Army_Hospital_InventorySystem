@extends('layout.app')
@section('title')
تفاصيل الإدخال
@endsection
@section('content')
<a href="\imports" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
                    <div class="container customerTable">
                        <div class="row">
                            <label class="col-md-3 col-5">السند العسكري :</label>
                            <p class="col-md-9 col-7">{{$import->orgin_number}}</p>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-5">ملاحظات :</label>
                            <p class="col-md-9 col-7">{{$import->notes}}</p>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-5">تاريخ الانشاء :</label>
                            <p class="col-md-9 col-7">{{$import->created_at->toFormattedDateString()}}</p>
                        </div>
                    </div>
                    <table class="payBillTable">
                        <tr>
                            <td class="payBillHeader" style="width:50px">المسلسل</td>
                            <td class="payBillHeader" style="width:100px">اسم الصنف</td>
                            <td class="payBillHeader" style="width:100px">الكمية</td>
                        </tr>
                            @foreach($import->inputDetails as $inputDetail)
                                <tr>
                                    <td>{{$inputDetail->product->id}}</td>
                                    <td>{{$inputDetail->product->name}}</td>
                                    <td>{{$inputDetail->quantity}}</td>
                                </tr>
                            @endforeach
                    </table>
                    <form id='deletefrom' method="POST" action="\imports/{{$import->id}}">
                        @csrf
                        @method('DELETE')
                        <button id='delete' class="btn btn-danger deleteProduct">حذف الإدخال</button>
                    </form>

@endsection
