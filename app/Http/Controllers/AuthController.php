<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $redirectRoute = $request->user()?->role === 'admin'
            ? 'admin.index'
            : 'dashboard';

        return redirect()->intended(route($redirectRoute));
    }

    public function dashboard(Request $request): View
    {
        return view('dashboard', [
            'user' => $request->user(),
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
