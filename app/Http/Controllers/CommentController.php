<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Idea $idea) {
        // dd($request->content);
        $comment = new Comment;
        $comment->idea_id = $idea->id;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment posted successfully' );
    }
}