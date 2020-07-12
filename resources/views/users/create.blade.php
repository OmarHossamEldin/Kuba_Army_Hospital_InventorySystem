@extends('layout.app')
@section('title')
انشاء مستخدم جديد
@endsection
@section('content')
<a href="/dashboard" class="btn btn-light backButton">رجوع <i class="fas fa-backward"></i></a>
            <form class="addProduct" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <label for="name" >الاسم:</label>
                        <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus><br>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <label for="username">اسم المستخدم:</label>
                        <input id="username" type="text" class="{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('email') }}" required><br>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                        <label for="password">كلمة المرور:</label>
                        <input id="password" type="text" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required><br>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                        <label for="password-confirm">تاكيد كلمة المرور:</label>
                        <input id="password-confirm" type="text" name="password_confirmation" required><br>
                        <label for="level">تصريح:</label>
                        <select name="level">
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select><br>
                        @if ($errors->has('level'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('level') }}</strong>
                        </span>
                        @endif

                        <input type="submit" class="btn btn-info"  value="إضافة المستخدم">
            </form>
@endsection
