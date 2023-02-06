<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // feedback
    public function postFeedback(Request $request)
    {    
        $email = $request->email;
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return response([
                'status' => 402,
                'message' => 'Invalid email address'
            ]);
        }

        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->message = $request->message;
        $feedback->save();
        

        return response([
            'status' => 200,
            'message' => 'Feedback Sent successfully',
        ]);
    }
}
