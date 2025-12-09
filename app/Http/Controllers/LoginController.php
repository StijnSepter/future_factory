<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle the login form submission.
     */
    public function login(Request $request)
    {
        // 1. Validate the input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'], 
        ]);

        // 2. Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            /** @var \App\Models\User $user */
            $user = Auth::user(); 

            // 3. Redirect based on the user's role (Clean and consolidated)
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->isPlanner()) {
                // Assuming you meant '/editor/dashboard' for Planner
                return redirect()->intended('/mechanic/dashboard');
            } elseif ($user->isMechanic()) {
                // Assuming you meant '/author/dashboard' for Mechanic
                return redirect()->intended('/buyer/dashboard');
            }
            
            // Default redirect (e.g., for 'User' role)
            return redirect()->intended('/dashboard'); 
        }

        // 4. If login fails, throw validation exception
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}