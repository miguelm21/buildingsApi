<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes
});

Route::post('authenticate', ['uses'=>'Api\ApiAuthController@authenticate']);
Route::post('register', ['uses'=>'Api\ApiAuthController@register']);

Route::get('profile', ['uses' => 'Api\ApiProfileController@index']);
Route::post('profile', ['uses' => 'Api\ApiProfileController@store']);
Route::put('profile/{profile}', ['uses' => 'Api\ApiProfileController@update']);
Route::delete('profile/{profile}', ['uses' => 'Api\ApiProfileController@destroy']);

Route::get('partnership', ['uses' => 'Api\ApiPartnershipController@index']);
Route::post('partnership', ['uses' => 'Api\ApiPartnershipController@store']);
Route::put('partnership/{partnership}', ['uses' => 'Api\ApiPartnershipController@update']);
Route::delete('partnership/{partnership}', ['uses' => 'Api\ApiPartnershipController@destroy']);

Route::get('provider', ['uses' => 'Api\ApiProvidersController@index']);
Route::post('provider', ['uses' => 'Api\ApiProvidersController@store']);
Route::put('provider/{provider}', ['uses' => 'Api\ApiProvidersController@update']);
Route::delete('provider/{provider}', ['uses' => 'Api\ApiProvidersController@destroy']);
