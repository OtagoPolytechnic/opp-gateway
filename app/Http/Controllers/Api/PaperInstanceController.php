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

        //echo($resourceData);
        // Add the papers to the response data object
        $responseData->addData('resources', $resourceData->toArray());

        // Return our response with our data
        return response()->json($responseData->get());    

    }

  
}
