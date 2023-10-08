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

        
        
        return view('dashboard', [
            'ideas' => Idea::orderBy('created_at', 'DESC')->paginate(5)
        ]);
    }
}
