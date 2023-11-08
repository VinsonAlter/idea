<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request, Idea $idea) {
        // dd($request->content);
        // $comment = new Comment;
        // $comment->idea_id = $idea->id;
        // $comment->user_id = Auth::user()->id;
        // $comment->content = $request->content;
        // $comment->save();

        // new one
        // $validated = request()->validate([
        //     'content' => 'required|min:3|max:240'
        // ]);

        // validation via form request
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $validated['idea_id'] = $idea->id;
        Comment::create($validated);
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment posted successfully' );
    }
}