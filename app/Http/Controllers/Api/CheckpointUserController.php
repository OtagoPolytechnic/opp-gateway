<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Checkpoint;
use App\Checkpoint_User;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class CheckpointUserController extends Controller
{
    public function createScore(Request $request, Checkpoint $checkpoint)
    {
        //Get post data to build mark
        //TODO validate data?
        $score = $request->input('score');
        //Find user off user id provided
        $user = User::find($request->input('user_id'));

        //Check to see if this already exists!
        $search_for_cp = Checkpoint_User::where(['checkpoint_id'=>$checkpoint->id,
                                                 'user_id'=>$user->id]);
        if($search_for_cp->count()==1)
        {
            return response()->json(['error'=>'Score already exists'], 400);
        } else {
            $responseData = new ApiResponseData();

            $data = $checkpoint->createScore($user, $score);

            // Add the new checkpoint to the response data object
            $responseData->addData('checkpointScore', $data);

            // Return our response with our data
            return response()->json($responseData->get(), 201);
        }
    }

    public function deleteScore(Request $request, Checkpoint $checkpoint)
    {
        //Get post data
        //Find user off user id provided
        $user = User::find($request->input('user_id'));

        //Check to see if this already exists!
        $search_for_cp = Checkpoint_User::where(['checkpoint_id'=>$checkpoint->id,
                                                 'user_id'=>$user->id]);
        if($search_for_cp->count()==0)
        {
            return response()->json(['error'=>'Score does not exist'], 404);
        } else {
            $responseData = new ApiResponseData();
            $checkpoint->deleteScore($user);

            // Add the new checkpoint to the response data object
            $responseData->addMessage('Successfully deleted');

            // Return our response with our data
            return response()->json($responseData->get(), 200);
        }
    }
}