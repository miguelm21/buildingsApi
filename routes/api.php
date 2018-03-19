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
Route::get('types', ['uses' => 'Api\ApiProvidersController@types'])->middleware('jwt.auth');

Route::get('units/{units}', ['uses' => 'Api\ApiUnitsController@index'])->middleware('jwt.auth');
Route::post('unit', ['uses' => 'Api\ApiUnitsController@store'])->middleware('jwt.auth');
Route::get('unit/{unit}', ['uses' => 'Api\ApiUnitsController@show'])->middleware('jwt.auth');
Route::put('unit/{unit}', ['uses' => 'Api\ApiUnitsController@update'])->middleware('jwt.auth');
Route::delete('unit/{unit}', ['uses' => 'Api\ApiUnitsController@destroy'])->middleware('jwt.auth');

Route::get('managers', ['uses' => 'Api\ApiManagersController@index'])->middleware('jwt.auth');
Route::get('managers/{id}', ['uses' => 'Api\ApiManagersController@index2'])->middleware('jwt.auth');
Route::post('manager', ['uses' => 'Api\ApiManagersController@store'])->middleware('jwt.auth');
Route::get('manager/{managers}', ['uses' => 'Api\ApiManagersController@show'])->middleware('jwt.auth');
Route::put('manager/{managers}', ['uses' => 'Api\ApiManagersController@update'])->middleware('jwt.auth');
Route::delete('manager/{managers}', ['uses' => 'Api\ApiManagersController@destroy'])->middleware('jwt.auth');

Route::get('tasks', ['uses' => 'Api\ApiTasksController@index'])->middleware('jwt.auth');
Route::post('tasks', ['uses' => 'Api\ApiTasksController@store'])->middleware('jwt.auth');
Route::get('tasks/{tasks}', ['uses' => 'Api\ApiTasksController@show'])->middleware('jwt.auth');
Route::put('tasks/{tasks}', ['uses' => 'Api\ApiTasksController@update'])->middleware('jwt.auth');
Route::put('taskstatus/{tasks}', ['uses' => 'Api\ApiTasksController@updatestatus'])->middleware('jwt.auth');
Route::delete('tasks/{tasks}', ['uses' => 'Api\ApiTasksController@destroy'])->middleware('jwt.auth');

Route::get('payments/{id}', ['uses' => 'Api\ApiPaymentsController@index'])->middleware('jwt.auth');
Route::post('payment', ['uses' => 'Api\ApiPaymentsController@store'])->middleware('jwt.auth');
Route::get('payment/{payment}', ['uses' => 'Api\ApiPaymentsController@show'])->middleware('jwt.auth');
Route::put('payment/{payment}', ['uses' => 'Api\ApiPaymentsController@update'])->middleware('jwt.auth');
Route::delete('payment/{payment}', ['uses' => 'Api\ApiPaymentsController@destroy'])->middleware('jwt.auth');

Route::get('paymentshistories/{id}', ['uses' => 'Api\ApiPaymentsHistoriesController@index'])->middleware('jwt.auth');
Route::post('paymenthistory/', ['uses' => 'Api\ApiPaymentsHistoriesController@store'])->middleware('jwt.auth');
Route::get('paymenthistory/{id}', ['uses' => 'Api\ApiPaymentsHistoriesController@show'])->middleware('jwt.auth');
Route::put('paymenthistory/{id}', ['uses' => 'Api\ApiPaymentsHistoriesController@update'])->middleware('jwt.auth');
Route::delete('paymenthistory/{id}', ['uses' => 'Api\ApiPaymentsHistoriesController@destroy'])->middleware('jwt.auth');

Route::get('expenses/{id}', ['uses' => 'Api\ApiExpensesController@index'])->middleware('jwt.auth');
Route::get('expensesunits/{id}', ['uses' => 'Api\ApiExpensesController@index2'])->middleware('jwt.auth');
Route::get('expensesproviders/{id}', ['uses' => 'Api\ApiExpensesController@index3'])->middleware('jwt.auth');
Route::post('expense', ['uses' => 'Api\ApiExpensesController@store'])->middleware('jwt.auth');
Route::get('expense/{expense}', ['uses' => 'Api\ApiExpensesController@show'])->middleware('jwt.auth');
Route::put('expense/{expense}', ['uses' => 'Api\ApiExpensesController@update'])->middleware('jwt.auth');
Route::delete('expense/{expense}', ['uses' => 'Api\ApiExpensesController@destroy'])->middleware('jwt.auth');

Route::get('expensesbalances/{id}', ['uses' => 'Api\ApiExpensesBalanceController@index'])->middleware('jwt.auth');
Route::get('expensesbalancesunits/{id}', ['uses' => 'Api\ApiExpensesBalanceController@index2'])->middleware('jwt.auth');
Route::get('expensesbalancesproviders/{id}', ['uses' => 'Api\ApiExpensesBalanceController@index3'])->middleware('jwt.auth');
Route::post('expensebalance', ['uses' => 'Api\ApiExpensesBalanceController@store'])->middleware('jwt.auth');
Route::get('expensebalance/{expensebalance}', ['uses' => 'Api\ApiExpensesBalanceController@show'])->middleware('jwt.auth');
Route::put('expensebalance/{expensebalance}', ['uses' => 'Api\ApiExpensesBalanceController@update'])->middleware('jwt.auth');
Route::delete('expensebalance/{expensebalance}', ['uses' => 'Api\ApiExpensesBalanceController@destroy'])->middleware('jwt.auth');

Route::get('partnershipshistories/{id}/{date1}/{date2}', ['uses' => 'Api\ApiExpensesHistoriesController@index'])->middleware('jwt.auth');
Route::post('partnershiphistory/', ['uses' => 'Api\ApiExpensesHistoriesController@store'])->middleware('jwt.auth');
Route::get('partnershiphistory/{id}', ['uses' => 'Api\ApiExpensesHistoriesController@show'])->middleware('jwt.auth');
Route::put('partnershiphistory/{id}', ['uses' => 'Api\ApiExpensesHistoriesController@update'])->middleware('jwt.auth');
Route::delete('partnershiphistory/{id}', ['uses' => 'Api\ApiExpensesHistoriesController@destroy'])->middleware('jwt.auth');

Route::get('udeposits/{udeposits}', ['uses' => 'Api\ApiUnidentifiedDepositsController@index'])->middleware('jwt.auth');
Route::post('udeposit', ['uses' => 'Api\ApiUnidentifiedDepositsController@store'])->middleware('jwt.auth');
Route::get('udeposit/{udeposit}', ['uses' => 'Api\ApiUnidentifiedDepositsController@show'])->middleware('jwt.auth');
Route::put('udeposit/{udeposit}', ['uses' => 'Api\ApiUnidentifiedDepositsController@update'])->middleware('jwt.auth');
Route::delete('udeposit/{udeposit}', ['uses' => 'Api\ApiUnidentifiedDepositsController@destroy'])->middleware('jwt.auth');

Route::get('einformations/{einformations}', ['uses' => 'Api\ApiExpensesInformationController@index'])->middleware('jwt.auth');
Route::post('einformation', ['uses' => 'Api\ApiExpensesInformationController@store'])->middleware('jwt.auth');
Route::get('einformation/{einformation}', ['uses' => 'Api\ApiExpensesInformationController@show'])->middleware('jwt.auth');
Route::put('einformation/{einformation}', ['uses' => 'Api\ApiExpensesInformationController@update'])->middleware('jwt.auth');
Route::delete('einformation/{einformation}', ['uses' => 'Api\ApiExpensesInformationController@destroy'])->middleware('jwt.auth');

Route::get('jdatas/{jdatas}', ['uses' => 'Api\ApiJudgmentDataController@index'])->middleware('jwt.auth');
Route::post('jdata', ['uses' => 'Api\ApiJudgmentDataController@store'])->middleware('jwt.auth');
Route::get('jdata/{jdata}', ['uses' => 'Api\ApiJudgmentDataController@show'])->middleware('jwt.auth');
Route::put('jdata/{jdata}', ['uses' => 'Api\ApiJudgmentDataController@update'])->middleware('jwt.auth');
Route::delete('jdata/{jdata}', ['uses' => 'Api\ApiJudgmentDataController@destroy'])->middleware('jwt.auth');

Route::get('oincomes/{oincomes}', ['uses' => 'Api\ApiOtherIncomeController@index'])->middleware('jwt.auth');
Route::post('oincome', ['uses' => 'Api\ApiOtherIncomeController@store'])->middleware('jwt.auth');
Route::get('oincome/{oincome}', ['uses' => 'Api\ApiOtherIncomeController@show'])->middleware('jwt.auth');
Route::put('oincome/{oincome}', ['uses' => 'Api\ApiOtherIncomeController@update'])->middleware('jwt.auth');
Route::delete('oincome/{oincome}', ['uses' => 'Api\ApiOtherIncomeController@destroy'])->middleware('jwt.auth');

Route::get('inotes/{inotes}', ['uses' => 'Api\ApiInformationNotesController@index'])->middleware('jwt.auth');
Route::post('inote', ['uses' => 'Api\ApiInformationNotesController@store'])->middleware('jwt.auth');
Route::get('inote/{inote}', ['uses' => 'Api\ApiInformationNotesController@show'])->middleware('jwt.auth');
Route::put('inote/{inote}', ['uses' => 'Api\ApiInformationNotesController@update'])->middleware('jwt.auth');
Route::delete('inote/{inote}', ['uses' => 'Api\ApiInformationNotesController@destroy'])->middleware('jwt.auth');

Route::get('mdetails/{mdetails}', ['uses' => 'Api\ApiManagersDetailsController@index'])->middleware('jwt.auth');
Route::post('mdetail', ['uses' => 'Api\ApiManagersDetailsController@store'])->middleware('jwt.auth');
Route::get('mdetail/{mdetail}', ['uses' => 'Api\ApiManagersDetailsController@show'])->middleware('jwt.auth');
Route::put('mdetail/{mdetail}', ['uses' => 'Api\ApiManagersDetailsController@update'])->middleware('jwt.auth');
Route::delete('mdetail/{mdetail}', ['uses' => 'Api\ApiManagersDetailsController@destroy'])->middleware('jwt.auth');

Route::get('contributions/{contributions}', ['uses' => 'Api\ApiContributionsController@index'])->middleware('jwt.auth');
Route::post('contribution', ['uses' => 'Api\ApiContributionsController@store'])->middleware('jwt.auth');
Route::get('contribution/{contribution}', ['uses' => 'Api\ApiContributionsController@show'])->middleware('jwt.auth');
Route::put('contribution/{contribution}', ['uses' => 'Api\ApiContributionsController@update'])->middleware('jwt.auth');
Route::delete('contribution/{contribution}', ['uses' => 'Api\ApiContributionsController@destroy'])->middleware('jwt.auth');

Route::get('uunits/{uunits}', ['uses' => 'Api\ApiUsersUnitsController@index'])->middleware('jwt.auth');
Route::post('uunit', ['uses' => 'Api\ApiUsersUnitsController@store'])->middleware('jwt.auth');
Route::get('uunit/{uunit}', ['uses' => 'Api\ApiUsersUnitsController@show'])->middleware('jwt.auth');
Route::put('uunit/{uunit}', ['uses' => 'Api\ApiUsersUnitsController@update'])->middleware('jwt.auth');
Route::delete('uunit/{uunit}', ['uses' => 'Api\ApiUsersUnitsController@destroy'])->middleware('jwt.auth');