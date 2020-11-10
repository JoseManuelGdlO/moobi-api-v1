<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CrudController;

/*
|--------------------------------------------------------------------------
| API Routes
|-----------------------------------------------------41444444444444444
44444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444---------------------
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
});

Route::group([
    'prefix' => 'articles',
    'middleware' => 'auth:api'
], function(){
    Route::post('/createArticle', [ CrudController::class, 'createArticle']);
    Route::get('/getAllArticles', [ CrudController::class, 'getAllArticles']);
    Route::get('/getArticle/{id}', [ CrudController::class, 'getArticle']);
    Route::put('/updateArticle/{id}', [ CrudController::class, 'updateArticle']);
    Route::delete('/deleteArticle/{id}', [ CrudController::class, 'deleteArticle']);
});
