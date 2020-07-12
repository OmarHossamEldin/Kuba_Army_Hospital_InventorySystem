@extends('layout.app')
@section('title')
التقرير
@endsection
@section('script')
<script src="{{asset('js/report.js')}}"></script>
@endsection
@section('content')
 <a href="\dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>
    <div class="date reportDate">
      	<label>التاريخ من :</label>
        <input type="text" class="dateText1" id="dom-id"><br>
        <label>التاريخ الى :</label>
        <input type="text" class="dateText2" id="dom-id"><br>
        <button class="btn btn-info show">عرض</button>
    </div>
    <form class="reportForm">
        <div class="container reportCont">
            <div class="row">
                <label class="col-4">راس المال</label>
                <p class="col-8 capital"></p>
            </div>
            <div class="row">
                <label class="col-4">أجمالي مشتريات :</label>
                <p class="col-8 totalpurchase"></p>
            </div>
            <div class="row">
                <label class="col-4">أجمالي المرتبات المدفوعه :</label>
                <p class="col-8 totalpaiedsalaries"></p>
            </div>
            <div class="row">
                    <label class="col-4">أجمالي مصروفات :</label>
                    <p class="col-8 totalexpanses"></p>
            </div>
            <div class="row">
                    <label class="col-4">أجمالي ديون الموردين :</label>
                    <p class="col-8 totalloan"></p>
            </div>
            <div class="row">
                <label class="col-4">أجمالي مبيعات :</label>
            	<p class="col-8 totalsells"></p>
            </div>
            <div class="row">
                    <label class="col-4">اجمالي مبيعات نقدية:</label>
                    <p class="col-8 totalincome"></p>
            </div>
            <div class="row">
                <label class="col-4">اجمالي مستحقات التحصيل العملاء :</label>
                <p class="col-8 totalreceivable"></p>
            </div>
            <div class="row">
                <label class="col-4">اجمالي الارادات:</label>
                <p class="col-8 income"></p>
            </div>
            <div class="row">
                <label class="col-4">صافي:</label>
                <p class="col-8 balance"></p>
            </div>
        </div>
        <input type="submit" class="btn btn-info printreport" value="طباعة التقرير">
    </form>
@endsection