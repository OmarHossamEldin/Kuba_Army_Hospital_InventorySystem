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
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </head>
    <body>
    <div class="col-12 header">
        <a href='\'><h3>برنامج جرد المخزن</h3></a>
    </div>
    <div class="row-header">
        <div class='col-12'>
        @include('inc.message')
        </div>
    </div>
    @yield('content')
    </body>
</html>