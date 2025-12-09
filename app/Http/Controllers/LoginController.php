<?php

namespace App\Http\Controllers; // <-- CRITICAL: Must use the Controllers namespace

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User; // Correct case

class LoginController extends Controller // <-- CRITICAL: Must extend Controller
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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'], 
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */ // <-- THIS RESOLVES THE WARNING
            $user = Auth::user(); 
        }

        if ($user->isAdmin()) {
            return redirect()->intended('/admin/dashboard');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user(); 

            // Use the helper methods defined in your User model
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->isEditor()) {
                return redirect()->intended('/editor/dashboard');
            } elseif ($user->isauthor()) {
                return redirect()->intended('/author/dashboard');
            }
            
            return redirect()->intended('/dashboard'); 
        }

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