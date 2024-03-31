<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;   

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// for language translation routes
Route::get('lang/{lang}', function($lang) {
    App::setLocale($lang);
    // need to store the Locale inside a session
    session()->put('locale', $lang);
    // get the currently set locale for app
    // dd(App::getLocale());
    return redirect()->route('dashboard');
})->name('lang');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function() {
//     // via withoutMiddleware Method
//     // Route::post('', [IdeaController::class, 'store'])->name('store')->withoutMiddleware(['auth']);
//     // Route::get('{idea}', [IdeaController::class, 'show'])->name('show')->withoutMiddleware(['auth']);
    // Route::get('{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware' => 'auth'], function() {
         // Route::post('', [IdeaController::class, 'store'])->name('store');
//         Route::get('{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
//         Route::put('{idea}', [IdeaController::class, 'update'])->name('update');
//         Route::delete('{idea}', [IdeaController::class, 'destroy'])->name('destroy');
        // Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});

Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');

// adding route resource but without middleware for class show
Route::resource('ideas', IdeaController::class)->only(['show']);

// ideas/{idea}/comments
// to pass these to laravel route:resource, you can
Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['show']);

Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');

Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');

Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

Route::get('/terms', function() {
    return view('terms');
})->name('terms');

// accessing admin page
Route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function() {
    Route::get('', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    // replace above with route resource
    Route::resource('users', AdminUserController::class)->only('index');
    
    // Route::get('/ideas', [AdminUserController::class, 'index'])->name('ideas');
    // replace above with route resource
    Route::resource('ideas', AdminIdeaController::class)->only('index');
});


