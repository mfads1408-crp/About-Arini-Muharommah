<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PreferenceController extends Controller
{
    public function index()
    {
        $preferences = auth()->user()->preferences()->get();
        return Inertia::render('Preferences/Index', [
            'preferences' => $preferences
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string|max:255',
        ]);
        
        auth()->user()->preferences()->create($validated);
        return back();
    }

    public function destroy(Preference $preference)
    {
        if ($preference->user_id === auth()->id()) {
            $preference->delete();
        }
        return back();
    }
}
