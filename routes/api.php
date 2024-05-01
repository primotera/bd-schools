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



// --------------------------Les Routes réservées aux users ---------------------------------


// Route::group(['prefix' => 'log', 'middleware' => ['auth', 'user']], function () {

    Route::get('/user/profile/info', [UserController::class, 'profileInfo']);
    Route::put('/user/update/{id}', [UserController::class, 'updateProfile']);
    Route::put('/user/logout', [UserController::class, 'updateProfile']);
    
    Route::get('/formation/grade/list', [FormationGradeController::class, 'index']);
    Route::post('/formation/grade/store', [FormationGradeController::class, 'store']);
    Route::put('/formation/grade/update/{id}', [FormationGradeController::class, 'update']);
    Route::get('/formation/grade/show/{id}', [FormationGradeController::class, 'show']);
    Route::delete('/formation/grade/delete/{id}', [FormationGradeController::class, 'destroy']);
    
    // });
    
    // --------------------------Les Routes réservées aux admins ---------------------------------
    
    // Route::group(['prefix' => 'log', 'middleware' => ['auth', 'admin']], function () {
        
        // --------------------------Les Routes liées aux rôles ---------------------------------

    Route::get('/role/list', [RoleController::class, 'index']);
    Route::post('/role/store', [RoleController::class, 'store']);
    Route::put('/role/update/{id}', [RoleController::class, 'update']);
    Route::get('/role/show/{id}', [RoleController::class, 'show']);
    Route::delete('/role/delete/{id}', [RoleController::class, 'destroy']);
    
    // --------------------------Les Routes liées aux utilisateurs -----------------------
    
    Route::post('/user/register', [UserController::class, 'register']);
    Route::get('/user/profile/info', [UserController::class, 'profileInfo']);
    Route::put('/user/update/{id}', [UserController::class, 'updateProfile']);
    Route::put('/user/logout', [UserController::class, 'logout']);
    Route::get('/user/list', [UserController::class, 'listUsers']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);
    
// });
