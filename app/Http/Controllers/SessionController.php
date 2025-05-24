<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($attributes)) {
            $request->session()->regenerate();
            // Set a cookie with the last used email for 30 days
            return redirect('/')->withCookie(cookie('last_email', $request->email, 43200));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }

}
