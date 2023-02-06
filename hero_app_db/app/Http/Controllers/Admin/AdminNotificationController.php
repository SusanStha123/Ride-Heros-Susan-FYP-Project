<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\KYCVerified;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function sendKYCVerifiedNotification($driverId)
    {
        $driver = User::find($driverId);
        $driver->notify(new KYCVerified());
        return response([
            'status' => 200,
            'driver' => $driver,
            'message' =>'Verified Notification'
        ]);
        
    }
}
