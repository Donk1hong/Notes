<?php

namespace App\Http\Controllers\Api\v1\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notes\StoreNoteRequest;
use App\Http\Requests\Api\Notes\UpdateNoteRequest;
use App\Http\Resources\Notes\MinifiedNotesResource;
use App\Http\Resources\Notes\NoteResource;
use OpenApi\Annotations as OA;

class NotesController extends Controller
{
     /**
     * @OA\Get(
     *   path="/api/v1/notes",
     *   operationId="Notes_Index",
     *   summary="Список заметок",
     *   tags={"Notes"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Не авторизован")
     * )
     */
    public function index()
    {
        $user = auth()->user();

        $notes = $user->notes()->get();

        if (auth()->check()) {
            if ($user->notes()->exists()) {
                 return MinifiedNotesResource::collection($notes);
            }
            return response()->json([
                'message' => 'У вас пока нет заметок.'
            ]);
        } else {
            return response()->json([
              'message' => 'Для просмотра заметок необходимо войти в аккаунт.'
            ], 401);
        }
    }

      /**
     * @OA\Post(
     *   path="/api/v1/notes",
     *   operationId="Notes_Store",
     *   summary="Создать заметку",
     *   tags={"Notes"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/NoteCreateRequest")),
     *   @OA\Response(response=201, description="Создано"),
     *   @OA\Response(response=422, description="Валидация")
     * )
     */
    public function store(StoreNoteRequest $request)
    {
        $user = auth()->user();

        $note = $user->notes()->create($request->validated());

        return response()->json([
           'message' => 'Вы успешно создали заметку.',
           'note' => new NoteResource($note)
       ], 201);
    }

    /**
     * @OA\Put(
     *   path="/api/v1/notes/{note_id}",
     *   operationId="Notes_Update",
     *   summary="Обновить заметку",
     *   tags={"Notes"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="note_id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/NoteUpdateRequest")),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=404, description="Не найдено"),
     *   @OA\Response(response=422, description="Валидация")
     * )
     *
     * @OA\Patch(
     *   path="/api/v1/notes/{note_id}",
     *   operationId="Notes_Patch",
     *   summary="Частично обновить заметку",
     *   tags={"Notes"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="note_id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/NoteUpdateRequest")),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=404, description="Не найдено"),
     *   @OA\Response(response=422, description="Валидация")
     * )
     */
    public function update(UpdateNoteRequest $request, $note_id)
    {
        $user = auth()->user();

        if (is_null($user->notes()->find($note_id))) {
            return response()->json([
                'message' => 'Такой заметки не существует.'
            ], 404);
        }

        $note = $user->notes()->find($note_id);

        $note->update($request->validated());

        return response()->json([
            'message' => 'Заметка обновлена',
            'note' => new NoteResource($note)
        ],200 );
    }

    /**
     * @OA\Delete(
     *   path="/api/v1/notes/{note_id}",
     *   operationId="Notes_Destroy",
     *   summary="Удалить заметку",
     *   tags={"Notes"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="note_id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="Удалено"),
     *   @OA\Response(response=404, description="Не найдено")
     * )
     */
    public function destroy($note_id)
    {
        $user = auth()->user();

        if (is_null($user->notes()->find($note_id))) {
            return response()->json([
                'message' => 'Такой заметки не существует.'
            ], 404);
        }

        $user->notes()->find($note_id)->delete();

        return response()->json([
           'message' => 'Заметка успешно удалена.'
        ]);
    }
}
