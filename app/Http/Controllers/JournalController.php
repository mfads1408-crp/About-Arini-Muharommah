<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JournalController extends Controller
{
    public function index()
    {
        $journals = auth()->user()->journals()->orderBy('date', 'desc')->get();
        return Inertia::render('Journals/Index', [
            'journals' => $journals
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'mood' => 'required|string|max:50',
            'date' => 'required|date',
        ]);
        
        auth()->user()->journals()->create($validated);
        return back();
    }

    public function destroy(Journal $journal)
    {
        if ($journal->user_id === auth()->id()) {
            $journal->delete();
        }
        return back();
    }
}
