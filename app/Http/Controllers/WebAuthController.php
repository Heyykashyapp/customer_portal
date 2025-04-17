<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class WebAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('index');
    }

   


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $user = Auth::user();
        $user->mfa_token = Str::random(6);
        $user->save();


        Mail::raw("Your MFA Code: {$user->mfa_token}", function ($msg) use ($user) {
            $msg->to($user->email)->subject("MFA Verification");
        });

        return redirect()->route('verify-mfa-form');
    }

    public function showMfaForm()
    {
        return view('verify-mfa');
    }

    public function verifyMfa(Request $request)
    {
        $user = Auth::user();

        if ($request->token !== $user->mfa_token) {
            return back()->withErrors(['token' => 'Invalid MFA token']);
        }

        $user->mfa_token = null;
        $user->save();

        return redirect()->route('customers.index');
    }
}
