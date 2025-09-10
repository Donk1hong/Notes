@extends('components.accountContent')

@section('title')
    Сброс пароля
@endsection

@section('account')
    <div class="container">
        <div class="card">
            <h2>Сброс пароля</h2>
            <form action="{{route('forgot-password.action')}}" method="post">
                @csrf
                <label for="text">Почта</label>
                <input type="email" id="email" name="email" placeholder="Введите почту" value="{{old('email')}}">
                @error('email')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror

                <button type="submit" style="margin-top: 15px;">
                    Выслать ссылку для сброса пароля
                </button>
                @if(session()->has('status'))
                    <div class="validation-success">
                        {{ session()->get('status') }}
                    </div>
                @endif
            </form>
            <p class="switch">Вернуться <a href="{{route('login.form')}}">назад</a></p>
        </div>
    </div>
@endsection
