<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request()->get('idea', ''));

        // $idea = new Idea();
        // $idea->content = 'test';
        // $idea->likes = 0;
        // $idea->save();

        // the above function can be shortened into below:
        // $idea = new Idea([
        //     'content' => request()->get('idea', '')
        // ]);
        // $idea->save();
        
        // adding validation
        // request()->validate([
        //     'content' => 'required|min:5|max:240',
        // ]);
        $validated = request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        // $validated['user_id'] = auth()->user()->id;
        $validated['user_id'] = Auth::user()->id;

        // dump(request()->all());
        // dd($validated);

        // the above method can be shortened into this
        // $idea = Idea::create([
        //     'content' => request()->input('content')
        // ]);

        // $idea = Idea::create(request()->all());

        // $idea->save();

        Idea::create($validated);
        
        return redirect()->route('dashboard')->with('success', 'Idea created successfully');

        // @dd(Idea::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        // return view('ideas.show', [
        //     'idea' => $idea
        // ]);
        // above function can be shortened via compact function
        // dd($idea->comments);

        return view('ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        if(Auth::user()->id !== $idea->user_id) {
            abort(403);
        }

        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        // request()->validate([
        //     'content' => 'required|min:5|max:240',
        // ]);

        // $idea->content = request()->get('content', '');
        // $idea->save();

        

        // the above method can be shortened into this
        // $idea = Idea::create([
        //     'content' => request()->input('CO')
        // ]);

        if(Auth::user()->id !== $idea->user_id) {
            abort(403);
        }

        // replacing above inefficient one with validated tech
        $validated = request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        // this is an example delete id, without binding
        // $idea = Idea::where('id', $id)->firstOrFail()->delete();
        // $idea->delete();
        // Idea::destroy($idea->id);
        // Idea::destroy($idea);
        // or
        if(auth()->id !== $idea->user_id) {
            abort(403);
        }

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }
}
