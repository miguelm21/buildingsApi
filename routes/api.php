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

Route::get('profilse', ['uses' => 'Api\ApiProfileController@index'])->middleware('jwt.auth');
Route::post('profiles', ['uses' => 'Api\ApiProfileController@store'])->middleware('jwt.auth');
Route::put('profiles/{profiles}', ['uses' => 'Api\ApiProfileController@update'])->middleware('jwt.auth');
Route::delete('profiles/{profiles}', ['uses' => 'Api\ApiProfileController@destroy'])->middleware('jwt.auth');

Route::get('partnerships', ['uses' => 'Api\ApiPartnershipController@index'])->middleware('jwt.auth');
Route::post('partnerships', ['uses' => 'Api\ApiPartnershipController@store'])->middleware('jwt.auth');
Route::put('partnerships/{partnerships}', ['uses' => 'Api\ApiPartnershipController@update'])->middleware('jwt.auth');
Route::delete('partnerships/{partnerships}', ['uses' => 'Api\ApiPartnershipController@destroy'])->middleware('jwt.auth');

Route::get('providers', ['uses' => 'Api\ApiProvidersController@index'])->middleware('jwt.auth')->middleware('jwt.auth');
Route::post('providers', ['uses' => 'Api\ApiProvidersController@store'])->middleware('jwt.auth');
Route::put('providers/{providers}', ['uses' => 'Api\ApiProvidersController@update'])->middleware('jwt.auth');
Route::delete('providers/{providers}', ['uses' => 'Api\ApiProvidersController@destroy'])->middleware('jwt.auth');

Route::get('units', ['uses' => 'Api\ApiUnitsController@index'])->middleware('jwt.auth')->middleware('jwt.auth');
Route::post('units', ['uses' => 'Api\ApiUnitsController@store'])->middleware('jwt.auth');
Route::put('units/{units}', ['uses' => 'Api\ApiUnitsController@update'])->middleware('jwt.auth');
Route::delete('units/{units}', ['uses' => 'Api\ApiUnitsController@destroy'])->middleware('jwt.auth');