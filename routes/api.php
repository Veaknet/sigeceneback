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
Route::middleware('auth:api')->group(function () {
    Route::get('user', function (Request $request) {
	    return response()->json(\App\User::all());
	});

    Route::get('user/{email}', function (Request $request) {
	    return response()->json(\App\User::where('email', $request->email)->first());
	});

    //Route::resource('questions', 'API\QuestionController');

	Route::apiResources([
		'questions' => 'API\QuestionController',
		'structures' => 'API\StructureController',
		'typequestion' => 'API\TypeQuestionController'
	]);
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json(\App\User::all());
});

Route::middleware('auth:api')->get('/user/{email}', function (Request $request) {
    return response()->json(\App\User::where('email', $request->email)->first());
});


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
