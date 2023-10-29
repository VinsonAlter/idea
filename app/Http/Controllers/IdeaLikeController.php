<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea) {
        // dd(Auth::user());
        $liker = Auth::user();

        $liker->likes()->attach($idea);

        return redirect()->route('dashboard')->with('success', 'liked successfully!');
    }

    public function unlike(Idea $idea) {
        $liker = Auth::user();

        $liker->likes()->detach($idea);

        return redirect()->route('dashboard')->with('success', 'unliked successfully!');
    }
}
