<?php

use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ClientController;

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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', [ AuthController::class, 'login']);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('/logout', [ AuthController::class, 'logout' ]);
        Route::get('/user', [ AuthController::class, 'user' ]);
    });
});

Route::group([
    'prefix' => 'events',
    'middleware' => 'auth:api'
], function () {
    Route::get('/getEvents/{idBusiness}', [ EventController::class, 'getEvents' ]);
    Route::get('/getDetailEvent/{idEvent}', [ EventController::class, 'getDetailEvent' ]);
    Route::post('/postEvent', [ EventController::class, 'getDetailEvent' ]);
});

Route::group([
    'prefix' => 'address',
    'middleware' => 'auth:api'
], function () {
    Route::post('/addAddress', [ AddressController::class, 'addAddress' ]);
});

Route::group([
    'prefix' => 'client',
    'middleware' => 'auth:api'
], function () {
    Route::post('/newClient', [ ClientController::class, 'newClient' ]);
});