<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExercisesTypeController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', "UserController@login");
    Route::post('register', "UserController@Register");
});


Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::apiResource('foods', "FoodController");
    Route::apiResource('exercises', "ExercisesController");
    Route::apiResource('exercises_types', "ExercisesTypeController");
    Route::apiResource('programes', "ProgrameController");
    Route::apiResource('services', "ServiceController");
    Route::apiResource('subscribe', "SubscribeController");
});
