<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


Route::get('/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');


Route::get('/home', function () {
    return view('home');
});



Route::get('/admin/dashboard', function () {
    return "Welcome, Admin!";
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// Editor OR Admin route (passes an array of allowed roles)
Route::get('/posts/create', function () {
    return "Create a new post.";
})->middleware(['auth', 'role:admin,editor'])->name('posts.create');

// Viewer route (for testing the default role)
Route::get('/view', function () {
    return "You are a viewer.";
})->middleware(['auth', 'role:viewer'])->name('viewer');
