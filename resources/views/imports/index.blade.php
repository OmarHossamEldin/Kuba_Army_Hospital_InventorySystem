@extends('layout.app')
@section('title')
سجل التوريدات
@endsection
@section('script')
<script src="{{asset('js/importshistory.js')}}"></script>
@endsection
@section('content')
<a href="/dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a><br>
<div class="date">
    @csrf
    <label>التاريخ من :</label>
    <input type="text" class="dateText1" id="dom-id" placeholder="1 Jan, 2020"><br>
    <label>التاريخ الى :</label>
    <input type="text" class="dateText2" id="dom-id" placeholder="1 Jan, 2020"><br>
    <button  class="btn btn-info show">عرض</button>
</div>
<table class="payBillTable">
    <tr>
        <td class="payBillHeader" style="width:50px">المسلسل</td>
        <td class="payBillHeader" style="width:150px">رقم السند العسكري</td>
        <td class="payBillHeader" style="width:100px">التاريخ</td>
        <td class="payBillHeader" style="width:100px">الحالة</td>
        <td class="payBillHeader" style="width:100px">ملاحظات</td>
        <td class="payBillHeader" style="width:50px">التفاصيل</td>
    </tr>
    <tbody class="importstablerows">
    @if(count($inputs)>0)
            @foreach($inputs as $input)
                <tr>
                    <td>{{$input->id}}</td>
                    <td>{{$input->orgin_number}}</td>
                    <td>{{$input->created_at->toFormattedDateString()}}</td>
                    <td>{{$input->State}}</td>
                    <td>{{$input->notes}}</td>
                    <td><a href="\imports/show/{{$input->id}}"><i class="fas fa-2x fa-ellipsis-h"></i></a></td>
                </tr>
            @endforeach
    @else
        <tr>
            <td>0</td>
            <td>لم تضاف اي توريدات بعد</td>
            <td>لم تضاف اي توريدات بعد</td>
            <td>لم تضاف اي توريدات بعد</td>
            <td>لم تضاف اي توريدات بعد</td>
            <td>لم تضاف اي توريدات بعد</td>
        </tr>
    @endif
    </tbody>
</table>
@endsection
