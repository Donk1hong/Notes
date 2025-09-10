@section('content')
    <div class="container">
        @if(auth()->guest())
        @else
            <form id="noteSearchForm" action="{{route('notes.search')}}" method="post">
                @csrf
                <div class="search-container">
                    <div class="search-input-wrapper">
                        <svg class="icon search-icon" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        <input
                            type="text"
                            class="search-input"
                            id="searchInput"
                            name="search"
                            placeholder="Поиск по заметкам..."
                            autocomplete="off"
                        >
                    </div>
                </div>
            </form>
        @endif
        <div class="notes-grid" id="searchResults">
            @if(auth()->guest())
                <div class="welcome-text is-visible">Войдите или зарегистрируйтесь, чтобы начать!</div>
            @else
                @include('components.noteCard', ['notes' => $notes])
            @endif
        </div>
            @if(auth()->guest())
            @else
                <button class="btn btn-primary floating-add-btn" id="openModal">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
            </button>
            @endif
    </div>
@endsection
