<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Checkpoint;
use App\Gradebook;
use App\User;

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
        $weight = $request->input('weight');
        $date = $request->input('date');

        $checkpoint = ['weight'=>$weight, 'date'=>$date];

        $data = $gradebook->addCheckpoint($checkpoint);

        // Add the new checkpoint to the response data object
        $responseData->addData('checkpoint', $data);

        // Return our response with our data
        return response()->json($responseData->get());
    }

    public function retrieve(Gradebook $gradebook)
    {
        $responseData = new ApiResponseData();

        $data = $gradebook->checkpoints;

        // Add the new checkpoint to the response data object
        $responseData->addData('checkpoints', $data);

        // Return our response with our data
        return response()->json($responseData->get());
    }

    public function createMark(Request $request, Checkpoint $checkpoint)
    {
        $responseData = new ApiResponseData();

        //Get post data to build mark
        //TODO validate data?
        $score = $request->input('score');
        //Find user off user id provided
        $user = User::find($request->input('user'));

        $data = $checkpoint->createMark($user, $score);

        // Add the new checkpoint to the response data object
        $responseData->addData('checkpointMark', $data);

        // Return our response with our data
        return response()->json($responseData->get());
    }
}
