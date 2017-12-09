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
Route::get('token', ['uses'=>'Api\ApiAuthController@token'])->middleware('jwt.auth');

Route::get('profiles', ['uses' => 'Api\ApiProfileController@index'])->middleware('jwt.auth');
Route::post('profile', ['uses' => 'Api\ApiProfileController@store'])->middleware('jwt.auth');
Route::get('profile/{profile}', ['uses' => 'Api\ApiProfileController@show'])->middleware('jwt.auth');
Route::put('profile/{profile}', ['uses' => 'Api\ApiProfileController@update'])->middleware('jwt.auth');
Route::delete('profile/{profile}', ['uses' => 'Api\ApiProfileController@destroy'])->middleware('jwt.auth');

Route::get('partnerships', ['uses' => 'Api\ApiPartnershipController@index'])->middleware('jwt.auth');
Route::post('partnerships', ['uses' => 'Api\ApiPartnershipController@store'])->middleware('jwt.auth');
Route::get('partnerships/{partnerships}', ['uses' => 'Api\ApiPartnershipController@show'])->middleware('jwt.auth');
Route::put('partnerships/{partnerships}', ['uses' => 'Api\ApiPartnershipController@update'])->middleware('jwt.auth');
Route::delete('partnerships/{partnerships}', ['uses' => 'Api\ApiPartnershipController@destroy'])->middleware('jwt.auth');

Route::get('providers', ['uses' => 'Api\ApiProvidersController@index'])->middleware('jwt.auth');
Route::post('providers', ['uses' => 'Api\ApiProvidersController@store'])->middleware('jwt.auth');
Route::get('providers/{providers}', ['uses' => 'Api\ApiProvidersController@show'])->middleware('jwt.auth');
Route::put('providers/{providers}', ['uses' => 'Api\ApiProvidersController@update'])->middleware('jwt.auth');
Route::delete('providers/{providers}', ['uses' => 'Api\ApiProvidersController@destroy'])->middleware('jwt.auth');

Route::get('units/{units}', ['uses' => 'Api\ApiUnitsController@index'])->middleware('jwt.auth')->middleware('jwt.auth');
Route::post('unit', ['uses' => 'Api\ApiUnitsController@store'])->middleware('jwt.auth');
Route::get('unit/{unit}', ['uses' => 'Api\ApiUnitsController@show'])->middleware('jwt.auth');
Route::put('unit/{unit}', ['uses' => 'Api\ApiUnitsController@update'])->middleware('jwt.auth');
Route::delete('unit/{unit}', ['uses' => 'Api\ApiUnitsController@destroy'])->middleware('jwt.auth');