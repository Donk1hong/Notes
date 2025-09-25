@section('header')
    <div class="container">
        <div class="header-content">
            <div class="header-title-section">
                <div class="header-title">
                    <span style="font-size: 20px">📝</span>
                    <h1>Мои заметки</h1>
                </div>
            </div>
            <div class="header-actions">
                @if(auth()->guest())
                    <a href="{{ route('login.form') }}" class="btn btn-primary">Вход и регистрация</a>
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

