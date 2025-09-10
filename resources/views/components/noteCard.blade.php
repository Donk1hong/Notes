@foreach($notes as $note)
    <article class="note-card" id="openNoteCardModel">
        <div class="note-header">
            <h3 class="note-title">{{$note->title}}</h3>
            <div class="note-actions">
                <button class="btn btn-ghost btn-sm" data-id="{{ $note->id }}" aria-label="Редактировать">
                    <svg class="icon icon-sm" viewBox="0 0 24 24">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                    </svg>
                </button>
                <form action="{{route('notes.delete', $note->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-ghost btn-sm" aria-label="Удалить">
                        <svg class="icon icon-sm" viewBox="0 0 24 24">
                            <polyline points="3,6 5,6 21,6"/>
                            <path d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="note-category">
            <span class="category-badge category-{{strtolower($note->category)}}">{{ mb_convert_case( __('category.' .  strtolower($note->category)) , MB_CASE_TITLE, "UTF-8")}}</span>
        </div>
        <div class="note-content">
            {{$note->description}}
        </div>
        <div class="note-footer">
            <svg class="icon icon-sm" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            @if($note->created_at == $note->updated_at)
                <span>Добавлено {{$note->created_at->format('d.m.Y')}} г.</span>
            @endif
            @if($note->created_at != $note->updated_at)
                <span>Изменено  {{$note->updated_at->format('d.m.Y')}} г.</span>
            @endif
        </div>
    </article>

    <div class="noteCardModal" id="noteCardModal">
        <div class="noteCardModal-overlay" id="closeNoteCardModal"></div>
        <div class="noteCardModal-content">
            <div class="noteCardModal-header">
                <h3>{{$note->title}}</h3>
                <button class="btn btn-ghost btn-icon" id="closeNoteCardModalBtb">✕</button>
            </div>

            <div class="noteCardModal-body">
                <span class="category-badge category-{{strtolower($note->category)}}" id="noteCardModalCategory">{{ mb_convert_case( __('category.' .  strtolower($note->category)) , MB_CASE_TITLE, "UTF-8")}}</span>
                <p>
                    {{$note->description}}
                </p>
            </div>

            <div class="noteCardModal-footer">
                @if($note->created_at == $note->updated_at)
                    <span>Добавлено {{$note->created_at}}</span>
                @endif
                @if($note->created_at != $note->updated_at)
                    <span>Изменено  {{$note->updated_at}}</span>
                @endif
            </div>
        </div>
    </div>
@endforeach
