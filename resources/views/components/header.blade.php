@section('header')
    <div class="container">
        <div class="header-content">
            <div class="header-title-section">
                <div class="header-title">
                    <span>📝</span>
                    <h1>Мои заметки</h1>
                </div>
            </div>
            <div class="header-actions">
                @if(auth()->guest())
                    <a href="{{route('login.form')}}"><button class="btn btn-primary">Вход и регистрация</button></a>
                @else
                    <form method="post" action="{{ route('logout.action') }}">
                        @csrf
                        <button type="submit" class="btn-logout">Выйти из аккаунта</button>
                    </form>
                @endif
            </div>
        </div>
        @include('components.noteModals')
    </div>
@endsection

