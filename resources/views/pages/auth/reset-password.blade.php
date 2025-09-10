@extends('components.accountContent')

@section('title')
    Сброс пароля
@endsection

@section('account')
    <div class="container">
        <div class="card">
            <h2>Сброс пароля</h2>
            <form action="{{route('password.reset', ['token' => $token])}}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <label for="text">Почта</label>
                <input type="email" id="email" name="email" placeholder="Введите почту" value="{{old('email')}}">
                @error('email')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <label for="password">Введите новый пароль</label>
                <input type="password" id="password" name="password" placeholder="Введите пароль">
                @error('password')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <label for="password"> Подтвердите пароль</label>
                <input type="password" id="password" name="password_confirmation" placeholder="Введите пароль">
                @error('password_confirmation')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror


                @if($errors->any())
                    <div class="validation-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="{{ $errors->any() ? 'error' : '' }}" style="margin-top: 15px;">
                    Установить пароль
                </button>
            </form>
        </div>
    </div>
@endsection
