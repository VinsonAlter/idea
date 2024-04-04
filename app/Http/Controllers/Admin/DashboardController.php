<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {
        
        // Log::info('inside admin dashboard controller');
        // if(!Gate::allows('admin')) {
        //     abort(403);
        // }

        // $this->authorize('admin');

        $totalUsers = User::count();

        $totalIdeas = Idea::count();

        $totalComments = Comment::count();

        return view('admin.dashboard', compact('totalUsers', 'totalIdeas', 'totalComments'));
    }
}
