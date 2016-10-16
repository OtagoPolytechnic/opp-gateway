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
Route::group(['before' => 'api', 'namespace' => 'Api'], function()
{
    Route::group(['prefix' => 'v1'], function()
    {
        //TODO This to be overwritten by merge
        /**
         * Papers
         */
        Route::get('papers', 'PaperController@all');

        /**
         * Users
         */
        Route::get('users', 'UserController@all');
        Route::get('users/{user_id}/papers', 'UserController@all');

        //End overwrite

        //New stuff by Arron and Josh
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
        //Assign a mark to a user for a checkpoint
        Route::post('checkpoints/{checkpoint}', 'CheckpointController@createMark');
        
    });

    Route::any('*', function()
    {
        return 'Route does not exist';
    })->where('path', '.*');
});

/**
 * Send all routes to the React index
 * Must come after API routes
 */
Route::any('{path?}', function()
{
    return view('index');
})->where('path', '.*');
