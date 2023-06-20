<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
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
Route::group(['prefix' => 'v1'], function () {
    // AUTH
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('me', [AuthController::class, 'me']);
        });
    });

    // PERMISSIONS
    Route::resource('permissions', PermissionController::class)
        ->middleware(['auth:sanctum', 'role:admin']);

    // ROLES
    Route::resource('roles', RoleController::class)
        ->middleware(['auth:sanctum', 'role:admin'])
        ->except('destroy');

    // POSTS
    Route::resource('posts', PostController::class)
        ->middleware(['auth:sanctum', 'role:admin,editor'])
        ->except('index', 'show');

    Route::group([
        'prefix' => 'posts',
        'as' => 'posts.',
        'middleware' => ['auth:sanctum', 'role:admin,editor,viewer']
    ], function () {
        Route::get('', [PostController::class, 'index']);
        Route::get('/{post}', [PostController::class, 'show']);
    });
});
