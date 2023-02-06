<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    // login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // check email
        $user = User::where('email', $fields['email'])->first();

        // check password
        if (!$user || !Hash::check($fields['password'], $user['password'])) {
            return response([
                'status' => 401,
                'message' => 'Invalid credentials',
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response([
            'status' => 200,
            'user' => $user,
            'token' => $token
        ]);
    }

    // register
    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $check_user = User::where('email', $email)->exists();

        if ($check_user) {
            return response([
                'status' => 404,
                'message' => 'This email address already exists'
            ]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response([
                'status' => 403,
                'message' => 'Invalid email address'
            ]);
        }

        if ($password !== $confirm_password) {
            return response([
                'status' => 402,
                'message' => "your password didn't match",
            ]);
        }

        if (mb_strlen($password) < 8) {
            return response([
                'status' => 405,
                'message' => "Your password must be at least 8 characters",
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->roles = $request->roles;
        $user->status = $request->status;
        $user->save();

        return response([
            'status' => 200,
            'message' => 'User registered successfully',
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        try {
            // Get bearer token from the request
            $accessToken = $request->bearerToken();

            // Get access token from database
            $token = PersonalAccessToken::findToken($accessToken);

            $token->delete();
            return response([
                'status' => 200,
                'message' => 'User logged out successfully',
            ]);
        } catch (Exception $exception) {
            return response([
                'status' => 401,
                'error' => "error" . $exception
            ]);
        }
    }
}
