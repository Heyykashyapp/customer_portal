<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) return response()->json($validator->errors(), 422);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mfa_token' => Str::random(6)
        ]);

        $token = $user->createToken('LaravelPassport')->accessToken;

        return response()->json(['token' => $token], 201);
    }




    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json(['error' => 'Invalid credentials'], 401);

        $user = Auth::user();
        $user->mfa_token = Str::random(6);
        $user->save();


        $token = $user->createToken('LaravelPassport')->accessToken;

        Mail::raw("Your MFA Code: {$user->mfa_token}", function ($msg) use ($user) {
            $msg->to($user->email)->subject("MFA Verification");
        });

        return response()->json(['token' => $token], 200);
    }


    public function verifyMfa(Request $request)
    {
        $user = Auth::user();
        if ($request->token !== $user->mfa_token)
            return response()->json(['error' => 'Invalid MFA token'], 403);

        $token = $user->createToken('FinalAccess')->accessToken;
        $user->mfa_token = null;
        $user->save();

        return response()->json(['token' => $token], 200);
    }



    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent to your email!']);
        }

        return response()->json(['message' => 'Failed to send password reset link.'], 400);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully']);
        }

        return response()->json(['message' => 'Failed to reset password.'], 400);
    }
}
