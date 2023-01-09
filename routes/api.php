<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('save_appointment', 'App\Http\Controllers\Api\AppointmentController@store');
Route::post('checkout', 'App\Http\Controllers\Api\AppointmentController@checkout');
Route::get('total_list', 'App\Http\Controllers\Api\AppointmentController@totalList');
Route::get('upcoming', 'App\Http\Controllers\Api\AppointmentController@upcoming');