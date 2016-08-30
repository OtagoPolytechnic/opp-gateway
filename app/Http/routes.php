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
        /**
         * Papers
         */
        Route::get('papers', 'PaperController@all');

        /**
         * Paper Instances
         */
        Route::get('paper-instances/{paper-instance}/resources', 'PaperInstanceController@resources');

        /**
         * Users
         */
        Route::get('users', 'UserController@all');
        Route::get('users/{user}/paper-instances', 'UserController@papers');
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
