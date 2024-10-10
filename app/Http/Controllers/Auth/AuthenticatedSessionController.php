<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
        // First, authenticate the user's credentials
        $request->authenticate();

        // Check if the user is active
        if (!$request->user()->is_active) {
            // Logout the user if they're inactive
            Auth::logout();

            // Throw a validation exception with an error message
            throw ValidationException::withMessages([
                'email' => 'Your account has been deactivated. Please contact support.',
            ]);
        }

        // Regenerate the session after a successful login
        $request->session()->regenerate();

        // Redirect based on user type
        if ($request->user()->usertype === 'admin') {
            return redirect()->route('admin.dashboard'); // Ensure this route exists
        }

        if ($request->user()->usertype === 'user') {
            return redirect()->route('user.dashboard'); // Ensure this route exists
        }

        // Fallback to default dashboard if no specific role is found
        return redirect()->intended(route('dashboard'));
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
