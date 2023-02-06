<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedback1 = [
            'name' => 'feedback1',
            'email' => 'feedback1@example.com',
            'message' => 'This is my feedback1 message 😄.',
        ];

        $feedback2 = [
            'name' => 'feedback2',
            'email' => 'feedback2@example.com',
            'message' => 'This is my feedback2 message 😄.',
        ];
        Feedback::create($feedback1);
        Feedback::create($feedback2);
    }
}
