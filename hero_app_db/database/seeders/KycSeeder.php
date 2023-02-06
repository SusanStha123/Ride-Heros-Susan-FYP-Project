<?php

namespace Database\Seeders;

use App\Models\Kyc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KycSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kyc = [
            'first_name' => 'Susan',
            'last_name' => 'Shrestha',
            'address' => 'Gothgaun',
            'email' => 'shresthasusan144@gmail.com',
            'phone' => '9819370064',
            'dob' => '2002/09/19',
            'image' => '/driver/kyc-img/1674707151download.png',
            'driver_id' => 3,
        ];
        
        Kyc::create($kyc);
    }
}
