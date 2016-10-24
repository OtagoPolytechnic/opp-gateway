<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;
use App\PaperInstance;
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
    
     public function papers(User $user)
    {
         $responseData = new ApiResponseData();
         $groups = $user->groups;
         
         $papers=$groups->map(function ($group){ return $group->paperInstance->paper;});
         
        $responseData->addData('User_PaperInstances', $papers->toArray());

        // Return our response with our data
        return response()->json($responseData->get());

    }
}
