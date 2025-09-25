<?php

namespace App\Http\Controllers\Application\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notes\NotesRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function create(NotesRequest $request) {

        $user = auth()->user();

        $note = $request->validated();

        $note['user_id'] = auth()->id();

        $user->notes()->create($note)->getPerPage();

        return redirect()->route('home');
    }

    public function edit(NotesRequest $request) {

        $user = auth()->user();

        $note = $user->notes();

        $note->update($request->validated());

        return redirect()->route('home');
    }

    public function delete() {

        $user = auth()->user();

        $note = $user->notes();

        $note->forceDelete();

        return redirect()->route('home');
    }

    public function search(Request $request) {

        $q = trim((string) $request->input('search', ''));

        $notes = $request->user()->notes()
            ->when($q !== '', function ($qb) use ($q) {
                $qb->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('components.noteCard', compact('notes'));
    }
}
