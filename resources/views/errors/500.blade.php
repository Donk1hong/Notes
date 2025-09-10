@extends('components.errorsContent')

@section('title-error')
    Ошибка 500
@endsection

@section('error-content')
    <main class="container main-content error-page">
        <section class="error-card">
            <div class="error-code">500</div>
            <h2 class="error-title">Внутренняя ошибка сервера</h2>
            <p class="error-message">
                Что-то пошло не так на нашей стороне. Мы уже разбираемся.
                Попробуйте обновить страницу или вернитесь на главную.
            </p>

            <div class="error-actions">
                <a class="btn btn-primary" href="{{route('home')}}" rel="nofollow">На главную</a>
            </div>
        </section>
    </main>
@endsection


