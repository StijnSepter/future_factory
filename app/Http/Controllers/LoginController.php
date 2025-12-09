<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
            'password' => ['required'], // You must add a password field to your form!
        ]);

        // 2. Attempt to log the user in (this sets the session key)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Redirect based on the user's role (optional, but helpful)
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            }
            // Add other role-based redirects here
            
            return redirect()->intended('/dashboard'); // Default redirect
        }

        // If login fails
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}