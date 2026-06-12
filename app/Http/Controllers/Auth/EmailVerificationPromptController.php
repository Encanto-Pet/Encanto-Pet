<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Redirect already-verified users to the dashboard;
     * everyone else goes to the OTP entry page.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard', absolute: false))
            : redirect()->route('otp.show');
    }
}
