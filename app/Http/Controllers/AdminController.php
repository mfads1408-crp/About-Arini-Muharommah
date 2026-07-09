<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        
        return Inertia::render('Admin/Dashboard', [
            'users' => $users
        ]);
    }

    public function showUserJournals(User $user)
    {
        $user->load('journals');
        
        return Inertia::render('Admin/Journals', [
            'user' => $user
        ]);
    }
}
