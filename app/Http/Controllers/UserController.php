<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * 
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5)->withQueryString();
        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $editing = true;
        $ideas = $user->ideas()->paginate(5)->withQueryString();
        return view('users.edit', compact('user', 'editing', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);  
        // $validated = request()->validate([
        //     'name' => 'required|min:3|max:40',
        //     'bio' => 'nullable|min:1|max:255',
        //     'image' => 'image',
        // ]);

        // set the validation via Form Request
        $validated = $request->validated();

        // if(request()->has('image')) {
        //     $imagePath = request()->file('image')->store('profile', 'public');
        //     $validated['image'] = $imagePath;

        //     Storage::disk('public')->delete($user->image ?? '');
        // }

        if($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        User::where('id', $user->id)->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(Auth::user());
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     */
    
}
