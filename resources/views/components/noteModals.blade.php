<div class="modal" id="noteModal">
    <div class="modal-overlay" id="closeModal"></div>
    <div class="modal-content">

        <div class="modal-header">
            <h3>Новая заметка</h3>
            <button class="btn btn-ghost btn-icon" id="closeBtn">&times;</button>
        </div>

        <form class="modal-body" action="{{ route('notes.create') }}" method="post">
            @csrf

            <label class="modal-label">Заголовок</label>
            <input type="text" class="modal-input @error('title') input-error @enderror" name="title" placeholder="Введите заголовок..." value="{{old('title')}}">

            @error('title')
            <div class="validation-error">
                {{ $message }}
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    noteModal.classList.add("show");
                });
            </script>
            @enderror

            <label class="modal-label">Категория</label>
            <select class="modal-input @error('category') input-error @enderror" name="category">
                <option value="work">Работа</option>
                <option value="personal">Личное</option>
                <option value="blog">Блог</option>
                <option value="default">Другое</option>
            </select>

            @error('category')
            <div class="validation-error">
                {{ $message }}
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    noteModal.classList.add("show");
                });
            </script>
            @enderror

            <label class="modal-label">Описание</label>
            <textarea class="modal-input @error('description') input-error @enderror " name="description" rows="5"  placeholder="Введите заметку..." >{{old('description')}}</textarea>

            @error('description')
            <div class="validation-error">
                {{ $message }}
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    noteModal.classList.add("show");
                });
            </script>
            @enderror

            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" id="cancelBtn">Отмена</button>
                <button type="submit" class="btn btn-primary {{ $errors->any() ? 'error' : '' }}">Сохранить</button>

            </div>
        </form>
    </div>
</div>
@foreach($notes as $note)
    <div class="modal" id="editModal-{{ $note->id }}">
        <div class="modal-overlay closeEdit" id="closeEditModal"></div>
        <div class="modal-content">

            <div class="modal-header">
                <h3>Редактировать заметку</h3>
                <button class="btn btn-ghost btn-icon btnEdit" id="closeEditBtn">&times;</button>
            </div>

            <form class="modal-body" action="{{ route('notes.update', $note->id)}}" method="post">
                @method('patch')
                @csrf

                <label class="modal-label">Заголовок</label>
                <input type="text" class="modal-input" name="title" placeholder="Введите заголовок..." value="{{$note->title}}">

                <label class="modal-label">Категория</label>
                <select class="modal-input" name="category">
                    <option value="work" @if($note->category === 'Work') selected @endif>Работа</option>
                    <option value="personal" @if($note->category === 'Personal') selected @endif>Личное</option>
                    <option value="blog" @if($note->category === 'Blog') selected @endif>Блог</option>
                    <option value="default" @if($note->category === 'Default') selected @endif>Другое</option>
                </select>

                <label class="modal-label">Описание</label>
                <textarea class="modal-input description" name="description" rows="5" placeholder="Введите заметку..." >{{$note->description}}</textarea>

                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost btnCancel" id="cancelEditBtn">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
