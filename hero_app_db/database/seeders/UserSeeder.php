<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        $admin = [
            'name'=>'Admin',
            'email' => 'admin@example.com',
            'roles' => 0,
            'status' => 1,
            'password' => bcrypt('admin@123'),
        ];
        
        // user
        $user1 = [
            'name'=>'User1',
            'email' => 'user1@example.com',
            'roles' => 1,
            'status' => 1,
            'password' => bcrypt('user1@123'),
            'lat-lng' => [
                28.26 => 29.28,
            ]
        ];

        $user2 = [
            'name'=>'User2',
            'email' => 'user2@example.com',
            'roles' => 1,
            'status' => 1,
            'password' => bcrypt('user2@123'),
            'lat-lng' => [
                28.26 => 29.28,
            ]
        ];

        // driver
        $driver1 = [
            'name'=>'Driver1',
            'email' => 'driver1@example.com',
            'roles' => 2,
            'status' => 0,
            'password' => bcrypt('driver1@123'),
        ];
        $driver2 = [
            'name'=>'Driver2',
            'email' => 'driver2@example.com',
            'roles' => 2,
            'status' => 0,
            'password' => bcrypt('driver2@123'),
        ];

        User::create($admin);
        User::create($user1);
        User::create($user2);
        User::create($driver1);
        User::create($driver2);
    }
}
