<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Consolidated Login Routes (Avoids duplicates)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Group routes that share the 'auth' middleware and your 'role' middleware
Route::middleware('auth')->group(function () {
    
    // Default logged-in home page (accessible to everyone)
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome'); // Added a name for clarity
    
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Admin Dashboard (requires 'admin' role)
    Route::get('/admin/dashboard', function () {
        return view('admin-dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    // Editor OR Author Routes (requires 'editor' or 'author' role)
    Route::get('/post/create', function () {
        return view('post-create');
    })->middleware('role:editor,author')->name('post.create');

    // Viewer Route (requires 'viewer' role)
    Route::get('/view', function () {
        // FIX: Ensure this view name matches your file name (e.g., 'viewer-page')
        return view('viewer-page'); 
    })->middleware('role:viewer')->name('view.page');
});