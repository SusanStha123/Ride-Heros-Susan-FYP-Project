<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Models\User;
use Illuminate\Http\Request;

class AdminKycController extends Controller
{
    // get kycs
    public function getKycs(){
        $allKycs = Kyc::all();
        return response([
            'status' => 200,
            'allKycs' => $allKycs
        ]);
    }

    // verify Kyc
    public function verifyKyc($driver_id){
        $driver = User::where('id',$driver_id)->first();
        return response([
            'status' => 200,
            '$driver' => $driver
        ]);
    }

    // update verify kyc status
    public function updateVerifyStatus(Request $request,$id){
        $user = User::find($id);
        $user->status = $request->status;
        $user->update();
        return response([
            'status' => 200,
            'user' => $user,
            'message' => 'Status updated successfully'
        ]);
    }

    // unverify kyc
    public function unverifyKyc($id){
        $driverKyc = Kyc::where('id',$id)->first();
        $driverKyc->delete();
        return response([
            'status' => 200,
            'driverKyc' => $driverKyc,
            'message' => 'Deleted unverified kyc successfully',
        ]);
    }


}
