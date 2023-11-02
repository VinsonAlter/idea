<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $followingsIds = $user->followings()->pluck('user_id');

        // dd($followingsIds);

        $ideas = Idea::whereIn('user_id', $followingsIds)->latest();

        if(request()->has('search')){
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }
        
        return view('dashboard', [
            'ideas' => $ideas->paginate(5)->withQueryString()
        ]);
    }
}
