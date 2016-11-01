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
        $papers = Paper::select(['name', 'code'])->get();

        // Add the papers to the response data object
        $responseData->addData('papers', $papers->toArray());

        // Return our response with our data
        return response()->json($responseData->get());
    }

    /** Find the paper instances for the given paper
    * @param $paper Particular paper
    * @return All paper-instances for the given paper
    */
    public function instances(Paper $paper)
    {
        $responseData = new ApiResponseData();

        $paperInstances = $paper->instances()->select([
            'paper_id',
            'date_block_id',
            'lecturer_group_id'
        ])->get();

        $responseData->addData('paper_instances', $paperInstances->toArray());
        
        // Return our response with our data
        return response()->json($responseData->get());
    }
}
