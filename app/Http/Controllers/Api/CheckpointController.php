<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Checkpoint;
use App\Gradebook;
use App\User;
use App\Checkpoint_User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class CheckpointController extends Controller
{
    public function create(Request $request, Gradebook $gradebook)
    {
        $responseData = new ApiResponseData();

        //Get post data to build checkpoint
        //TODO validate data?
        $name = $request->input('name');
        $weight = $request->input('weight');
        $total = $request->input('total');
        $date = $request->input('date');
        
        //TODO Check that a checkpoint with date doesn't already exist?
        $checkpoint = ['name'=>$name, 'weight'=>$weight, 'total'=>$total, 'date'=>$date];

        $data = $gradebook->addCheckpoint($checkpoint);

        // Add the new checkpoint to the response data object
        $responseData->addData('checkpoint', $data);

        // Return our response with our data
        return response()->json($responseData->get(), 201);
    }

    public function retrieve(Gradebook $gradebook)
    {
        $responseData = new ApiResponseData();

        //TODO Sort checkpoints by date?
        $data = $gradebook->checkpoints;

        // Add the new checkpoint to the response data object
        $responseData->addData('checkpoints', $data);

        // Return our response with our data
        return response()->json($responseData->get(), 200);
    }
}