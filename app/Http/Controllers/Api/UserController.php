<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class UserController extends Controller
{
    public function all()
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        // Get all users
        $users = User::select(['first_name', 'last_name', 'email'])->get();

        // Add the users to the response data object
        $responseData->addData('users', $users->toArray());

        // Return our response with our data
        return response()->json($responseData->get());
    }
}
