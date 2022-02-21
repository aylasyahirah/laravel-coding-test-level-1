<?php

use App\Http\Controllers\Api\v1\CreateEvent;
use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\Api\v1\GetActiveEvents;
use App\Http\Controllers\Api\v1\GetEvents;
use App\Http\Controllers\Api\v1\GetSpecificEvent;
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

Route::prefix('v1')->group(function () {
    Route::get('/events', [EventController::class, 'getAllEvents']);
    Route::get('/events/active-events', [EventController::class, 'getActiveEvents']);
    Route::get('/events/{id}', [EventController::class, 'getEvent']);
    Route::post('/events', [EventController::class, 'createEvent']);
    Route::put('/events/{id}', [EventController::class, 'eventUpdate']);
    Route::patch('/events/{id}', [EventController::class, 'eventUpdate']);
    Route::delete('/events/{id}', [EventController::class, 'deleteEvent']);
});
