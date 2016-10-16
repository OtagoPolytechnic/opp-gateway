<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Gradebook;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class GradebookController extends Controller
{
    public function create(Request $request)
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        

        //Get the paper instance to link the gradebook to
        $paper_instance_id = $request->input('paper_instance_id');

        //Create the Gradebook linked to paper_instance
        //if it doesn't already exist
        $data = Gradebook::firstOrCreate(['paper_instances_id'=>$paper_instance_id]);

        // Add the new gradebook to the response data object
        $responseData->addData('gradebook', $data);

        // Return our response with our data
        return response()->json($responseData->get());
    }

    public function retrieve(Gradebook $gradebook)
    {
        $responseData = new ApiResponseData();
        $responseData->addData('gradebook', $gradebook);

        // Return our response with our data
        return response()->json($responseData->get());
    }
}