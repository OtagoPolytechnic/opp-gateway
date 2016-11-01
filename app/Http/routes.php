<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * API version 1
 */
Route::group(['before' => 'api', 'namespace' => 'Api', 'middleware' => 'cors'], function()
{
    Route::group(['prefix' => 'v1'], function()
    {
        /**
         * Papers
         */
        Route::get('papers', 'PaperController@all');

        /**
         * Users
         */
        Route::get('users', 'UserController@all');
        Route::get('users/{user}/paper-instances', 'UserController@paperInstances');
        Route::get('users/{user}/calendars', 'UserController@calendars');
        Route::get('users/{user}/events', 'UserController@events');

        /**
         * Calendar
         */
        Route::get('calendars/{calendar}/events', 'CalendarContoller@events');
        Route::post('calendars/{calendar}/events', 'CalendarContoller@createEvent');
    });
});

/**
 * Send all routes to the React index
 * Must come after API routes
 */
Route::any('{path?}', function()
{
    return view('index');
})->where('path', '.*');
