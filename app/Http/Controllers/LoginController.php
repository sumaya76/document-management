<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{


    protected function authenticated($request, $user)
    {
        // Check if the user is an admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Default redirection for regular users
        return redirect()->route('dashboard');
    }

    // Ensure you have other methods such as create, store, and destroy defined here
}
