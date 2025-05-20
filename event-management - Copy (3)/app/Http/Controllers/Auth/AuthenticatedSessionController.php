<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Authenticate the user
    $request->authenticate();

    // Check if the authenticated user is blocked
    if ($request->user()->status === 'blocked') {
        Auth::logout(); // Log the user out
        return redirect()->route('login')->withErrors([
            'email' => 'Your account is blocked. Please contact the administrator.',
        ]);
    }

    // Regenerate session
    $request->session()->regenerate();

    // Redirect based on user role
    if ($request->user()->role === 'admin') {
        return redirect()->intended('admin/dashboard');
    }

    return redirect()->route('dashboard');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
