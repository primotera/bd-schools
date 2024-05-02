<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FormationGradeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// --------------------------Les Routes Libres d'accès ---------------------------------

Route::post('/user/login', [UserController::class, 'login']);



// --------------------------Les Routes réservées aux admins uniquement ---------------------------------


Route::group([
    'prefix' => 'log',
    'middleware' => 'admin'
], function () {

        // --------------------------Les Routes liées aux rôles ---------------------------------

        Route::get('/role/list', [RoleController::class, 'index']);
        Route::post('/role/store', [RoleController::class, 'store']);
        Route::put('/role/update/{id}', [RoleController::class, 'update']);
        Route::get('/role/show/{id}', [RoleController::class, 'show']);
        Route::delete('/role/delete/{id}', [RoleController::class, 'destroy']);

        
        // --------------------------Les Routes liées aux utilisateurs ---------------------------------
        
        Route::post('/user/register', [UserController::class, 'register']);
        Route::get('/user/list', [UserController::class, 'listUsers']);
        Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

});

// --------------------------Les Routes réservées aux admins ---------------------------------

Route::group(
    [
        'prefix' => 'log',
        'middleware' => 'admin', 'user'
    ],
    function () {

        // --------------------------Les Routes liées aux utilisateurs -----------------------

        Route::get('/user/profile/info', [UserController::class, 'profileInfo']);
        Route::put('/user/update/{id}', [UserController::class, 'updateProfile']);
        Route::put('/user/logout', [UserController::class, 'logout']);
    }
);
