<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        // $users = [
        //     [
        //         'name' => 'Alex',
        //         'age' => 30,
        //     ],
        //     [
        //         'name' => 'Dan',
        //         'age' => 25,
        //     ]
        // ];

        // return view('dashboard', [
        //     'users' => $users
        // ]);

        // return preview of Email
        // return new WelcomeEmail(Auth::user());

        // check if there is a search
        // if there is, check the search value with our data
        // eager loading stuffs via withCount()
        $ideas = Idea::orderBy('created_at', 'DESC');

        // $ideas = Idea::withCount('likes')->orderBy('created_at', 'DESC');

        if(request()->has('search')){
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        // count the number of ideas that each user has
        // stored inside global view inside function boot at AppServiceProvider
        // $topUsers = User::withCount('ideas')
        //             ->orderBy('ideas_count', 'DESC')
        //             ->limit(5)->get();

        return view('dashboard', [
            'ideas' => $ideas->paginate(5)->withQueryString(),
            // 'topUsers' => $topUsers
        ]);
    }
}
