<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Models\Idea;
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
        $ideas = Idea::orderBy('created_at', 'DESC');

        if(request()->has('search')){
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }
        
        return view('dashboard', [
            'ideas' => $ideas->paginate(5)->withQueryString()
        ]);
    }
}
