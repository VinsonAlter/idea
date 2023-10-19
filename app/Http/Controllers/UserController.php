<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * 
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     */
    public function edit(User $user)
    {
        $editing = true;
        return view('users.show', compact('user', 'editing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function update(User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     */
    
}
