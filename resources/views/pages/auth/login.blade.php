@extends('components.accountContent')

@section('title')
    Авторизация
@endsection

@section('account')
    <div class="container">
        <div class="card">
            <h2>Вход</h2>
            <form action="{{route('login.action')}}" method="post">
                @csrf
                <label for="text">Почта</label>
                <input type="email" id="email" class="@error('email') input-error @enderror" name="email" placeholder="Введите почту" value="{{old('email')}}">
                @error('email')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <label for="password">Пароль</label>
                <input type="password" id="password" class="@error('password') input-error @enderror" name="password" placeholder="Введите пароль">
                <a href="{{route('forgot-password.form')}}" class="forgot-password-link">Забыли пароль?</a>
                @error('password')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember_token">
                    <label for="remember">Сохранить вход</label>
                </div>

                <button type="submit" class="{{ $errors->any() ? 'error' : '' }}">Войти</button>
                @if(session()->has('success'))
                    <div class="validation-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('status'))
                    <div class="validation-success">
                        {{ session()->get('status') }}
                    </div>
                @endif
            </form>
            <p class="switch">Нет аккаунта? <a href="{{route('registration.form')}}">Зарегистрироваться</a></p>
        </div>
    </div>
@endsection
