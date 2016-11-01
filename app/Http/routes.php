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
        Route::get('papers/{paper}/instances', 'PaperController@instances');

        /**
         * Paper Instances
         */
        Route::get('paper-instances/{paperInstance}/resources', 'PaperInstanceController@resources');
        Route::get('paper-instances/{paperInstance}/students', 'PaperInstanceController@students');
        Route::get('paper-instances/{paperInstance}/lecturers', 'PaperInstanceController@lecturers');

        /**
         * Users
         */
        Route::get('users', 'UserController@all');
        Route::get('users/{user}/paper-instances', 'UserController@paperInstances');
        Route::get('users/{user}/calendars', 'UserController@calendars');
        Route::get('users/{user}/events', 'UserController@events');
        Route::get('users/{user}/papers', 'UserController@papers');

        /**
         * Gradebooks
         */
        //Create a new gradebook(or return existing)
        Route::post('gradebooks', 'GradebookController@create');

        //Retrieve a particular Gradebook
        Route::get('gradebooks/{gradebook}', 'GradebookController@retrieve');

        /**
         * Checkpoints
         */
        //Create a new checkpoint
        Route::post('gradebooks/{gradebook}/checkpoints', 'CheckpointController@create');
        //Get all the checkpoints for this gradebook
        Route::get('gradebooks/{gradebook}/checkpoints', 'CheckpointController@retrieve');


        /**
         * Checkpoint_user (scores)
         */
        //Give a student a score
        Route::post('scores/{checkpoint}', 'CheckpointUserController@createScore');
        //Delete a student score
        Route::delete('scores/{checkpoint}', 'CheckpointUserController@deleteScore');
        Route::patch('scores/{checkpoint}', 'CheckpointUserController@patchScore');

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
