@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
@endsection

@section('header')
<a href="/register" class="toRegister">Register</a>
@endsection

@section('content')
<h1>Login</h1>
<div class="login-form">
    <form action="/login" method="post">
        @csrf
        <div class="login-item">
            <p>メールアドレス</p>
            <input name="email" type="email" placeholder="例: test@exapmple.com" value="{{old('email')}}">
            <div class="error-message">
                @error('email')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="login-item">
            <p>パスワード</p>
            <input name="password" type="password" placeholder="例: coachtech1106">
            <div class="error-message">
                @error('password')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="login-button">
            <button type="submit">ログイン</button>
        </div>
    </form>
</div>

@endsection