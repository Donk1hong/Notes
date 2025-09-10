@extends('components.accountContent')

@section('title')
    Регистрация
@endsection

@section('account')
    <div class="container">
        <div class="card">
            <h2>Регистрация</h2>
            <form action="{{route('registration.action')}}" method="post">
                @csrf
                <label for="email">Почта</label>
                <input type="email" id="email" class="@error('email') input-error @enderror" name="email" placeholder="Введите почта" value="{{old('email')}}">
                @error('email')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <label for="password">Пароль</label>
                <input type="password" id="password" class="@error('password') input-error @enderror" name="password" placeholder="Введите пароль" value="{{old('password')}}">
                @error('password')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <label for="password">Подтверждение пароля</label>
                <input type="password" id="password" class="@error('password_confirmation') input-error @enderror" name="password_confirmation" placeholder="Введите подтверждение пароля" value="{{old('password_confirmation')}}">
                @error('password_confirmation')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <button type="submit" class="{{ $errors->any() ? 'error' : '' }}">Создать аккаунт</button>
            </form>
            <p class="switch">Уже есть аккаунт? <a href="{{route('login.form')}}">Войти</a></p>
        </div>
    </div>
@endsection
