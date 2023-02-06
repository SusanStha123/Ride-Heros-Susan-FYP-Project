<?php

use App\Http\Controllers\Admin\AdminDriverController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\AdminKycController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Driver\DriverKycController;
use App\Http\Controllers\Driver\DriverVehicleController;
use App\Http\Controllers\Feedback\FeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Start Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forget-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/check-email-verification-code', [PasswordResetController::class, 'checkEmailVerificationCode']);
Route::post('/set-new-password', [PasswordResetController::class, 'setNewPassword']);
// End Auth

// Start Feedback
Route::post('/feedback', [FeedbackController::class, 'postFeedback']);
// End Feedback

// Start Admin
Route::get('/get-users', [AdminUserController::class, 'getUsers']);
Route::get('/get-drivers', [AdminDriverController::class, 'getDrivers']);
Route::get('/get-feedbacks', [AdminFeedbackController::class, 'getFeedbacks']);
Route::get('/get-kycs', [AdminKycController::class, 'getKycs']);
Route::get('/verify-kycs/{driver_id}', [AdminKycController::class, 'verifyKyc']);
Route::get('/unverify-kycs/{driver_id}', [AdminKycController::class, 'unverifyKyc']);
Route::post('/update-verify-status/{id}', [AdminKycController::class, 'updateVerifyStatus']);
// End Admin

// Start Driver

// End Driver

// Start Chat
Route::post('/messages', [ChatController::class, 'message']);
// End Chat


Route::middleware('auth:sanctum')->group(function () {
    // logout
    Route::get('/logout', [AuthController::class, 'logout']);
    // add vehicle
    Route::post('/add-vehicle', [DriverVehicleController::class, 'addVehicle']);
    // update vehicle 
    Route::post('/update-vehicle/{id}', [DriverVehicleController::class, 'updateVehicle']);
    // delete vehicle 
    Route::get('/delete-vehicle/{id}', [DriverVehicleController::class, 'deleteVehicle']);
    // get myVehicle
    Route::get('/get-myvehicles', [DriverVehicleController::class, 'getMyVehicle']);
    // post kyc
    Route::post('/add-kyc', [DriverKycController::class, 'addKyc']);
    // notify kyc verify to driver
    Route::post('/notification/kyc-verified/{driverId}', [AdminNotificationController::class, 'sendKYCVerifiedNotification']);
});
