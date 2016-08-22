<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Libraries\ApiResponseData;
use App\Http\Controllers\Controller;
use App\Paper;

class ClassMaterialController extends Controller
{
    public function all()
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        // Get the class materials
        $classMaterials = Paper::select(['name', 'github_url', 'year_level'])->get()->groupBy('year_level');

        // Add the class materials to the response data object
        $responseData->addData('class_materials', $classMaterials->toArray());

        // Return our response with our data
        return response()->json($responseData->get());
    }
}
