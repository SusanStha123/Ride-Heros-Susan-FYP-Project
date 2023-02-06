<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle = [
            'name' => 'Pulsar',
            'brand' => 'Bajaj',
            'category' => 'Bike',
            'description' => 'This is a pulsar bike',
            'image' => '/driver/vehicle-img/pulsarns.png',
            'driver_id' => 4,
        ];
        Vehicle::create($vehicle);
    }
}
