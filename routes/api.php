<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProspectionController;
use App\Http\Controllers\UserController;

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
    Route::post('/addEvent', [ EventController::class, 'addEvent' ]);
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
    Route::get('/getClients/{idBusiness}', [ ClientController::class, 'getClients' ]);
    Route::get('/detailClient/{idClient}', [ ClientController::class, 'detailClient' ]);
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'auth:api'
], function () {
    Route::post('/addUser', [ UserController::class, 'addUser' ]);
    Route::put('/updatePass', [ UserController::class, 'updatePass' ]);
    Route::put('/deleteUser/{id}', [ UserController::class, 'deleteUser' ]);
});

Route::group([
    'prefix' => 'prospection'
], function () {
    Route::post('/addProspection', [ ProspectionController::class, 'addProspection' ]);
});


