<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title','برنامج جرد المخزن')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/daterangepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/moment.min.js')}}"></script>
        <script src="{{asset('js/jquery.daterangepicker.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/operation.js')}}"></script>
        <script src="{{asset('js/jquery.PrintArea.js')}}"></script>
        <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('js/globalebackend.js')}}"></script>
        @yield("script")
    </head>
    <body>
    <div class="container-fluid projectContainer">
                    <div class="row">
                        <div class="col-12 header">
                            <a href='\dashboard'><h3>برنامج جرد المخزن</h3></a>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-2 dashbordManu">
                                    <ul>
                                        <li class="salesDashboard">
                                            <span>صرف  <i class="fas fa-caret-down"></i></span>
                                            <ul class="salesSubDash">
                                                <li><a href="\outputs/create">صرف من المخزن</a></li>
                                                <li><a href="\outputs">سجلات صرف</a></li>
                                            </ul>
                                        </li>
                                        <li class="purchasesDashboard">
                                            <span>توريدات المخزن <i class="fas fa-caret-down"></i></span>
                                            <ul class="purchasesSubDash">
                                                <li><a href="\imports/create">ﺃﺿﺎﻓﺔ توريد الي المخزن</a></li>
                                                <!-- <li><a href="\reverse">اﺿﺎﻓﺔ ﻣﺮﺗﺠﻊ توريد من المخزن</a></li> -->
                                                <li><a href="\imports">ﺳﺠﻞ التوريدات</a></li>
                                            </ul>
                                        </li>
                                        <li class="stockDashboard">
                                                <span>الأصناف <i class="fas fa-caret-down"></i></span>
                                                <ul class="stockSubDash">
                                                    <li><a href="\categories\create">إضافة قسم</a></li>
                                                    <li><a href="\categories">بيانات الأقسام</a></li>
                                                    <li><a href="\products/create">إضافة الأصناف</a></li>
                                                    <li><a href="\products">جرد المخزن</a></li>
                                                </ul>
                                        </li>
                                        @if(Auth::user()->level==1)
                                            <li class="userDashboard">
                                                <span>المستخدمين <i class="fas fa-caret-down"></i></span>
                                                <ul class="userDashboardSubDash">
                                                    <li><a href="{{route('users.create')}}">إضافة مستخدم</a></li>
                                                    <li><a href="\users">بيانات المستخدمين</a></li>
                                                    <li><a href="\user/activites">نشاطات المستخدمين</a></li>
                                                </ul>
                                            </li>
                                        @endif
                                        @if(Auth::user()->level==1)
                                            <li class="reportDashboard">
                                                <a href="#"><span>تقرير </span></a>
                                            </li>
                                        @endif
                                        <li class="logout">
                                            <a href="{{ route('signout') }}">
                                                <span><i class="fas fa-sign-out-alt"></i>تسجيل الخروج</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
            <div class="col-10">
                @include('inc.message')
                @yield('content')
            </div>
        </div>
    </div>
    </body>
    </html>
