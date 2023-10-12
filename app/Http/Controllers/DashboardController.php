<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

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

        // check if there is a search
        // if there is, check the search value with our data
        $ideas = Idea::orderBy('created_at', 'DESC');

        if(request()->has('search')){
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }
        
        return view('dashboard', [
            'ideas' => $ideas->paginate(5)
        ]);
    }
}
