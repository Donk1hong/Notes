@extends('components.errorsContent')

@section('title-error')
    Ошибка 404
@endsection

@section('error-content')
    <main class="container main-content error-page">
        <section class="error-card">
            <div class="error-code">404</div>
            <h2 class="error-title">Страница не найдена</h2>
            <p class="error-message">
                Веб-сервер не смог найти запрошенную пользователем страницу или файл по указанному адресу.
            </p>

            <div class="error-actions">
                <a class="btn btn-primary" href="{{route('home')}}" rel="nofollow">На главную</a>
            </div>
        </section>
    </main>
@endsection


