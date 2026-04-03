<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlannerController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\User;
use App\Http\Controllers\MechanicController;


// Consolidated Login Routes (Avoids duplicates)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/vehicles', [MechanicController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{id}', [MechanicController::class, 'show'])->name('vehicles.show');


// Base Dashboard Route - Protected by authentication
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


Route::get('/dashboard/vehicles/create', [MechanicController::class, 'create'])
    ->middleware('auth', 'role:author')
    ->name('vehicles.create');

Route::get('/dashboard/planner/add_to_agenda', [PlannerController::class, 'addToAgenda'])
    ->name('planner.add_to_agenda');

Route::prefix('dashboard/planner')
    ->middleware(['auth', 'role:editor'])
    ->group(function () {
        Route::get('/', [PlannerController::class, 'index'])->name('planner.index');
        Route::get('/create', [PlannerController::class, 'create'])->name('planner.create');
        Route::post('/', [PlannerController::class, 'store'])->name('planner.store');
    });

// Group routes that share the 'auth' middleware and your 'role' middleware
Route::middleware('auth')->group(function () {

    // Default logged-in home page (accessible to everyone)
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/agenda', function () {
        return view('agenda');
    })->name('agenda');


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

