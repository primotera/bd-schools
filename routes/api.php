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
        'middleware' => ['admin']
    ],
    function () {

        // --------------------------Les Routes liées aux utilisateurs -----------------------

        Route::get('/users', [UserController::class, 'listUsers']);
        Route::get('/user/profile/info', [UserController::class, 'profileInfo']);
        Route::put('/user/update/{id}', [UserController::class, 'updateProfile']);
        Route::post('/user/logout', [UserController::class, 'logout']);

        // --------------------------Les Routes liées aux schools ---------------------------------

        Route::get('/schools', [SchoolController::class, 'index']);
        Route::post('/schools', [SchoolController::class, 'store']);
        Route::put('/schools/{id}', [SchoolController::class, 'update']);
        Route::get('/schools/{id}', [SchoolController::class, 'show']);
        Route::delete('/schools/{id}', [SchoolController::class, 'destroy']);

        // --------------------------Les Routes liées aux grades de formations ---------------------------------

        Route::get('/formation_grades', [FormationGradeController::class, 'index']);
        Route::post('/formation_grades', [FormationGradeController::class, 'store']);
        Route::put('/formation_grades/{id}', [FormationGradeController::class, 'update']);
        Route::get('/formation_grades/{id}', [FormationGradeController::class, 'show']);
        Route::delete('/formation_grades/{id}', [FormationGradeController::class, 'destroy']);
        
        // --------------------------Les Routes liées aux subDomains ---------------------------------

        Route::get('/subdomains', [SubDomainController::class, 'index']);
        Route::post('/subdomains', [SubDomainController::class, 'store']);
        Route::put('/subdomains/{id}', [SubDomainController::class, 'update']);
        Route::get('/subdomains/{id}', [SubDomainController::class, 'show']);
        Route::delete('/subdomains/{id}', [SubDomainController::class, 'destroy']);
        
        // --------------------------Les Routes liées aux formations ---------------------------------

        Route::get('/formations', [FormationController::class, 'index']);
        Route::post('/formations', [FormationController::class, 'store']);
        Route::put('/formations/{id}', [FormationController::class, 'update']);
        Route::get('/formations/{id}', [FormationController::class, 'show']);
        Route::delete('/formations/{id}', [FormationController::class, 'destroy']);


    }
);
