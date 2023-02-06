<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User Seed
        $this->call(UserSeeder::class);
        // Feedback Seed
        $this->call(FeedbackSeeder::class);
        // Vehicle Seed
        $this->call(VehicleSeeder::class);
        // Kyc Seed
        $this->call(KycSeeder::class);
    }
}
