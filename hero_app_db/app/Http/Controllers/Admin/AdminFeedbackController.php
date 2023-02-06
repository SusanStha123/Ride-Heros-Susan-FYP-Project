<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function getFeedbacks(){
        $allFeedbacks = Feedback::all();
        return response([
            'status' => 200,
            'allFeedbacks' => $allFeedbacks,
        ]);
    }
}
