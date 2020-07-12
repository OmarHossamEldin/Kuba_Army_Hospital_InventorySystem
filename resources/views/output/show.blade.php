@extends('layout.app')
@section('title')
تفاصيل صرف
@endsection
@section('content')
<a href="\outputs" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
                    <div class="container customerTable">
                        <div class="row">
                            <label class="col-md-3 col-5">مكان التوريد :</label>
                            <p class="col-md-9 col-7">{{$output->place}}</p>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-5">ملاحظات :</label>
                            <p class="col-md-9 col-7">{{$output->notes}}</p>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-5">تاريخ الانشاء :</label>
                            <p class="col-md-9 col-7">{{$output->created_at->toFormattedDateString()}}</p>
                        </div>
                    </div>
                    <table class="payBillTable">
                        <tr>
                            <td class="payBillHeader" style="width:50px">المسلسل</td>
                            <td class="payBillHeader" style="width:100px">اسم الصنف</td>
                            <td class="payBillHeader" style="width:100px">الكمية</td>
                        </tr>
                            @foreach($output->OutputDetails as $OutputDetail)
                                <tr>
                                    <td>{{$OutputDetail->product->id}}</td>
                                    <td>{{$OutputDetail->product->name}}</td>
                                    <td>{{$OutputDetail->quantity}}</td>
                                </tr>
                            @endforeach
                    </table>
                    <form id='deletefrom' method="POST" action="\outputs/{{$output->id}}">
                        @csrf
                        @method('DELETE')
                        <button id='delete' class="btn btn-danger deleteProduct">حذف الصرف</button>
                    </form>

@endsection
