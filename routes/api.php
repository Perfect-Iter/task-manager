<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StatusController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



    Route::group(['prefix' =>'auth'], function(){
        Route::post('/register',[AuthController::class, 'register']);
        Route::post('/login',[AuthController::class, 'login']);

    });

    Route::group(['prefix' =>'status'], function(){

        Route::get('/',[StatusController::class, 'index']);
        Route::get('/{id}',[StatusController::class, 'show']);
        Route::post('/create',[StatusController::class, 'store']);
        Route::post('/{id}/update',[StatusController::class, 'update']);
        Route::delete('/{id}/delete',[StatusController::class, 'destroy']);

    });

    Route::group(['prefix' =>'task'], function(){

        Route::get('/',[TaskController::class, 'index']);

        Route::post('/create',[TaskController::class, 'store']);

        Route::post('/start',[TaskController::class, 'start_task']);
        Route::post('/end',[TaskController::class, 'end_task']);

    });
