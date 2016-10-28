<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseData;

class UserController extends Controller
{
    public function all()
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        // Get all users
        $users = User::select(['first_name', 'last_name', 'email'])->get();

        // Add the users to the response data object
        $responseData->addData('users', $users->toArray());

        // Return our response with our data
        return response()->json($responseData->get());
    }

    /**
     * Events in calendars this user subscribes to
     */
    public function events(User $user)
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        // Get all events
        $events = $user->events();

        // Add the events to the response data object
        $responseData->addData('events', $events->toArray());

        // Return our response with our data
        return response()->json($responseData->get());
    }

    /**
     * Events in calendars this user subscribes to
     */
    public function calendars(User $user)
    {
        // Make a new API Response Data object
        $responseData = new ApiResponseData();
        
        // Get all this user's subscribed calendars
        $calendars = $user->subscribedCalendars()->select('owner_id', 'name', 'colour')->get();

        foreach ($calendars as $calendar) {
            $calendar['owned_by_user'] = $calendar['owner_id'] == $user->id;
            unset($calendar['owner_id']);
        }

        // Add the users to the response data object
        $responseData->addData('calendars', $calendars->toArray());

        // Return our response with our data
        return response()->json($responseData->get());
    }
}
