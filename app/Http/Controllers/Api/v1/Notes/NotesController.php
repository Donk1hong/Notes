<?php

namespace App\Http\Controllers\Api\v1\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notes\StoreNoteRequest;
use App\Http\Requests\Api\Notes\UpdateNoteRequest;
use App\Http\Resources\Notes\MinifiedNotesResource;
use App\Http\Resources\Notes\NoteResource;

class NotesController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $notes = $user->notes()->get();

        if (auth()->check()) {
            if ($user->notes()->exists()) {
                 return MinifiedNotesResource::collection($notes);
            }
            return response()->json([
                    'message' => 'У вас пока нет заметок'
                ]);
        } else {
            return response()->json([
              'message' => 'Для просмотра заметок необходимо войти в аккаунт'
            ], 401);
        }
    }

    public function store(StoreNoteRequest $request)
    {
        $user = auth()->user();

        $note = $user->notes()->create($request->validated());

        return response()->json([
           'message' => 'Вы успешно создали заметку',
           'note' => new NoteResource($note)
       ], 201);
    }

    public function update(UpdateNoteRequest $request, $note_id)
    {

        $user = auth()->user();

        if (is_null($user->notes()->find($note_id))) {
            return response()->json([
                'message' => 'Такой заметки не существует'
            ], 404);
        }

        $note = $user->notes()->find($note_id);

        $note->update($request->validated());

        return response()->json([
            'message' => 'Заметка обновлена',
            'note' => new NoteResource($note)
        ],200 );
    }

    public function destroy($note_id)
    {
        $user = auth()->user();

        if (is_null($user->notes()->find($note_id))) {
            return response()->json([
                'message' => 'Такой заметки не существует'
            ], 404);
        }

        $user->notes()->find($note_id)->delete();

        return response()->json([
           'message' => 'Заметка успешно удаленна'
        ]);
    }
}
