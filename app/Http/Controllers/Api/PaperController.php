<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Paper;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class PaperController extends Controller
{
    public function all()
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        // Get all papers
        $classMaterials = Paper::select(['name', 'code'])->get();

        // Add the papers to the response data object
        $responseData->addData('class_materials', $classMaterials->toArray());

        // Return our response with our data
        return response()->json($responseData->get());
    }
}
