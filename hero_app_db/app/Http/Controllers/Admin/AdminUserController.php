<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function getUsers(){
        $allUsers = User::where('roles',1)->get();
        return response([
            'status' => 200,
            'allUsers' => $allUsers
        ]);
    }
}
