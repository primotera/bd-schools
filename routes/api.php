<?php

use App\Http\Controllers\Api\FormationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FormationGradeController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\SubDomainController;

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

        // --------------------------Les Routes liées aux schools ---------------------------------

        Route::get('/school/list', [SchoolController::class, 'index']);
        Route::post('/school/store', [SchoolController::class, 'store']);
        Route::put('/school/update/{id}', [SchoolController::class, 'update']);
        Route::get('/school/show/{id}', [SchoolController::class, 'show']);
        Route::delete('/school/delete/{id}', [SchoolController::class, 'destroy']);

        // --------------------------Les Routes liées aux grades de formations ---------------------------------

        Route::get('/formation/grade/list', [FormationGradeController::class, 'index']);
        Route::post('/formation/grade/store', [FormationGradeController::class, 'store']);
        Route::put('/formation/grade/update/{id}', [FormationGradeController::class, 'update']);
        Route::get('/formation/grade/show/{id}', [FormationGradeController::class, 'show']);
        Route::delete('/formation/grade/delete/{id}', [FormationGradeController::class, 'destroy']);
        
        // --------------------------Les Routes liées aux subDomains ---------------------------------

        Route::get('/subdomain/list', [SubDomainController::class, 'index']);
        Route::post('/subdomain/store', [SubDomainController::class, 'store']);
        Route::put('/subdomain/update/{id}', [SubDomainController::class, 'update']);
        Route::get('/subdomain/show/{id}', [SubDomainController::class, 'show']);
        Route::delete('/subdomain/delete/{id}', [SubDomainController::class, 'destroy']);
        
        // --------------------------Les Routes liées aux formations ---------------------------------

        Route::get('/formation/list', [FormationController::class, 'index']);
        Route::post('/formation/store', [FormationController::class, 'store']);
        Route::put('/formation/update/{id}', [FormationController::class, 'update']);
        Route::get('/formation/show/{id}', [FormationController::class, 'show']);
        Route::delete('/formation/delete/{id}', [FormationController::class, 'destroy']);


    }
);
