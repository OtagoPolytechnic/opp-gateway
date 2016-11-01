<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Auth;
use App\Calendar;
use App\Http\Requests;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class CalendarContoller extends Controller
{
    public function events(Calendar $calendar)
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        // Get all events for this calendar
        $events = $calendar->events()->select(['id', 'name', 'start_time', 'duration', 'place'])->get();

        // Add the events to the response data object
        $responseData->addData('events', $events->toArray());

        // Return the ApiResponseData, with the events for this calendar, as JSON
        return response()->json($responseData->get());
    }

    public function createEvent(Calendar $calendar, EventRequest $request)
    {
        $user = Auth::user();
        $postData = $request->all();

        $eventData = [
            'name' => $postData['name'],
            'start_time' => \Carbon\Carbon::parse($postData['start_time']),
            'duration'=> $postData['duration'],
        ];

        if (!empty($postData['place'])) {
            $eventData['place'] = $postData['place'];
        }

        $event = $calendar->events()->create($eventData);

        $responseData = new ApiResponseData();
        $responseData->addData('new_event', $event);

        return response()->json($responseData->get());
    }
}
