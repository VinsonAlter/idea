<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index() {
        
        // Log::info('inside admin dashboard controller');
        // if(!Gate::allows('admin')) {
        //     abort(403);
        // }
        // $this->authorize('admin');
        $users = User::latest()->paginate(5);

        return view('admin.users.index', compact('users'));
    }
}
