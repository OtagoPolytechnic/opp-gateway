<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\PaperInstance;
use App\Paper;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class PaperInstanceController extends Controller
{
    public function resources(PaperInstance $paperInstance)
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        $resourceData = $paperInstance->resources()->select(['id', 'name', 'url'])->get();

        // Add the papers to the response data object
        $responseData->addData('resources', $resourceData->toArray());

        // Return our response with our data
        return response()->json($responseData->get());    

    }

    public function students(PaperInstance $paperInstance)
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();

        //Get all student groups and then all users in those groups
        $resourceData = $paperInstance->studentsGroups->map(function ($group){ return $group->users;});

        //Add the students to the response data object
        $responseData->addData('users', $resourceData->toArray());
        
        // Return our response with our data
        return response()->json($responseData->get()); 
    }

    public function lecturers(PaperInstance $paperInstance)
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();

        //Get all student groups and then all users in those groups
        $resourceData = $paperInstance->lecturersGroup->users;

        //Add the students to the response data object
        $responseData->addData('users', $resourceData->toArray());
        
        // Return our response with our data
        return response()->json($responseData->get()); 
    }
}
