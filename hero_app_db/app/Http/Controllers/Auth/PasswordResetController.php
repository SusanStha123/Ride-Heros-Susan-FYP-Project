<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Password_Reset;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class PasswordResetController extends Controller
{
	// forgot Password
	public function forgotPassword(Request $request)
	{
		try {
			$email = $request->email;
			$check_user = User::where('email', $email)->exists();

			if (!$check_user) {
				return response([
					'status' => 402,
					'message' => 'Email does not exists',
				]);
			}
			$token = rand(1000, 9999);
			DB::table('password_resets')->insert([
				'email' => $request->email,
				'token' => $token,
				'created_at' => Carbon::now()
			]);
			Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
				$message->to($request->email);
				$message->subject('Reset Password');
			});

			return response([
				'status' => 200,
				'email' => $email,
				'token' => $token,
				'message' => 'We have email your password reset code',
			]);
		} catch (Exception $err) {
			return response([
				'status' => 401,
				'message' => 'Cannot send password reset link',
				'error' => "error" . $err,
			]);
			throw $err;
		}
	}

	// check Email Verification Code
	public function checkEmailVerificationCode(Request $request)
	{
		try {
			$check = DB::table('password_resets')
				->where([
					'email' => $request->email,
					'token' => $request->token
				])
				->first();

			if (!$check) {
				return response([
					'status' => 403,
					'message' => 'Not a valid email verification code',
				]);
			}

			return response([
				'status' => 200,
				'message' => 'Valid email verification code',
			]);
		} catch (Exception $err) {
			return response([
				'status' => 401,
				'message' => 'Cannot verify email verification code',
				'error' => "error" . $err,
			]);
			throw $err;
		}
	}

	// set New Password
	public function setNewPassword(Request $request)
	{
		try {
			$password = $request->password;
			$confirm_password = $request->confirm_password;

			if ($password !== $confirm_password) {
				return response([
					'status' => 402,
					'message' => "your password didn't match",
				]);
			}

			if (mb_strlen($password) < 8) {
				return response([
					'status' => 403,
					'message' => "Your password must be at least 8 characters",
				]);
			}

			$user = User::where('email', $request->email)
				->update(['password' => Hash::make($request->password)]);

			DB::table('password_resets')->where(['email' => $request->email])->delete();

			return response([
				'status' => 200,
				'message' => 'Your password has been changed successfully',
			]);
		} catch (Exception $err) {
			return response([
				'status' => 401,
				'message' => 'Cannot verify email verification code',
				'error' => "error" . $err,
			]);
			throw $err;
		}
	}
}
