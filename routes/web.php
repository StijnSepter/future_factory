<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\PlannerController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\User;

// Consolidated Login Routes (Avoids duplicates)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Base Dashboard Route - Protected by authentication
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
    

// Group routes that share the 'auth' middleware and your 'role' middleware
Route::middleware('auth')->group(function () {
    
    // Default logged-in home page (accessible to everyone)
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    
    Route::get('/home', function () {
        return view('home');
    })->name('home');

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

Route::middleware(['auth', 'role:' . User::ROLE_EDITOR])->group(function () {
    // 1. Show the form for creating a new Vehicle/Task
    Route::get('/planner/create_vehicle', [PlannerController::class, 'create'])
        ->name('planner.create_vehicle');

    // 2. Handle the form submission and store the new Vehicle
    Route::post('/planner/store_vehicle', [PlannerController::class, 'store'])
        ->name('planner.store_vehicle');
});
