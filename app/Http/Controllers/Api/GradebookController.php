<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Gradebook;
use App\PaperInstance;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class GradebookController extends Controller
{
    public function create(Request $request)
    {
        //Get the paper instance to link the gradebook to
        $paper_instance_id = $request->input('paper_instance_id');

        //Check and see if a gradebook already exists
        if (PaperInstance::find($paper_instance_id)->gradebook != null)
        {
            return response()->json(['error'=>'Gradebook already exists'], 400);
        } else {
            // Make a new API Response Data object
            $responseData = new ApiResponseData();
            //Create the Gradebook linked to paper_instance
            $data = Gradebook::create(['paper_instance_id'=>$paper_instance_id]);

            // Add the new gradebook to the response data object
            $responseData->addData('gradebook', $data);

            // Return our response with our data
            return response()->json($responseData->get(), 200);
        }
    }

    public function retrieve(Gradebook $gradebook)
    {
        $responseData = new ApiResponseData();
        $responseData->addData('gradebook', $gradebook);

        // Return our response with our data
        return response()->json($responseData->get());
    }
}