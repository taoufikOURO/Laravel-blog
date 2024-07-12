<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//Page par defaut
Route::redirect('/', 'posts');

Route::resource('posts',PostController::class);
Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');



//utilisateurs authentifiés
Route::middleware(['auth'])->group(function () {
    //logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});


//utilisateurs non authentifiés
Route::middleware(['guest'])->group(function () {
    //register
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    //login
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});
