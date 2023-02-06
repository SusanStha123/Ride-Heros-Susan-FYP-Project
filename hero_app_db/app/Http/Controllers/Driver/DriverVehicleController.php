<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DriverVehicleController extends Controller
{
    public function addVehicle(Request $request)
    {
        $vehicle = new Vehicle();
        $image = $request->file('image');
        $new_image = time().$image->getClientOriginalName();
        $image->move('driver/vehicle-img/',$new_image);
        $vehicle->image = '/driver/vehicle-img/'.$new_image;
        $vehicle->name = $request->name;
        $vehicle->brand = $request->brand;
        $vehicle->category = $request->category;
        $vehicle->description = $request->description;
        $vehicle->driver_id = auth()->user()->id;
        $vehicle->save();

        return response([
            'status' => 200,
            'message' => 'Vehicle added successfully',
        ]);
    }

    public function updateVehicle(Request $request,$id)
    {
        $vehicle = Vehicle::find($id);
        $image = $request->file('image');
        $new_image = time().$image->getClientOriginalName();
        $image->move('driver/vehicle-img/',$new_image);
        $vehicle->image = '/driver/vehicle-img/'.$new_image;
        $vehicle->name = $request->name;
        $vehicle->brand = $request->brand;
        $vehicle->category = $request->category;
        $vehicle->description = $request->description;
        $vehicle->driver_id = auth()->user()->id;
        $vehicle->update();

        return response([
            'status' => 200,
            'message' => 'Vehicle updated successfully',
        ]);
    }

    public function deleteVehicle($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return response([
            'status' => 200,
            'message' => 'Vehicle deleted successfully',
        ]);

    }

    // get my vehicle according to user
    public function getMyVehicle()
    {
        $myVehicle = Vehicle::where('driver_id', auth()->user()->id)->first();
        return response([
            'status' => 200,
            'myVehicle' => $myVehicle,
            'message' => 'Vehicle get successfully',
        ]);
    }
}
