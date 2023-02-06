<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use Exception;
use Illuminate\Http\Request;

class DriverKycController extends Controller
{
    public function addKyc(Request $request)
    {
        try {
            $email = $request->email; 
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                return response([
                    'status' => 403,
                    'message' => 'Invalid email address'
                ]);
            }
            $kyc = new Kyc();
            $image = $request->file('image');
            $new_image = time().$image->getClientOriginalName();
            $image->move('driver/kyc-img/',$new_image);
            $kyc->image = '/driver/kyc-img/'.$new_image;
            $kyc->first_name = $request->first_name;
            $kyc->middle_name = $request->middle_name;
            $kyc->last_name = $request->last_name;
            $kyc->address = $request->address;
            $kyc->email = $request->email;
            $kyc->phone = $request->phone;
            $kyc->dob = $request->dob;
            $kyc->driver_id = auth()->user()->id;
            $kyc->save();
            
            return response([
                'status' => 200,
                'message' => 'KYC added successfully',
            ]);
        } catch (Exception $exception) {
            return response([
                'exception' => 'error'.$exception,
            ]);
        }
        
    }
}
