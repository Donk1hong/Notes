<?php

namespace App\Http\Controllers\Api\v1\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notes\StoreNoteRequest;
use App\Http\Requests\Api\Notes\UpdateNoteRequest;
use App\Http\Resources\Notes\MinifiedNotesResource;
use App\Http\Resources\Notes\NoteResource;
use App\Models\Note;
use App\Models\User;

class NotesController extends Controller
{

    public function index()
    {
        return MinifiedNotesResource::collection(
            Note::all()
        );
    }

    public function store(StoreNoteRequest $request)
    {
       $notes = $request->user()->notes()->create($request->validated());
       return response()->json($this->show($notes), )->setStatusCode(201, 'Note created');
    }

    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $notes = $request->user()->notes()->update($request->validated());

        return response()->json($this->show($notes))->setStatusCode(200, 'Note updated');
    }

    public function destroy(Note $note)
    {
        $note->forceDelete();
    }
}
