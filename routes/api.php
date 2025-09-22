<?php

use App\Http\Controllers\Api\v1\Notes\NotesController;
use App\Http\Controllers\Api\v1\Users\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can registration.blade.php API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {
    Route::controller(UsersController::class)->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::middleware('guest.api')->group(function () {
                Route::post('register', 'register');
                Route::post('login', 'login');
                Route::post('forgot/password', 'forgotPassword');
            });
            Route::get('user', 'show');
            Route::post('logout', 'logout');
        });

    });

    Route::controller(NotesController::class)->prefix('user')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('notes', 'index');
            Route::post('note/create', 'store');
            Route::patch('note/update/{note_id}', 'update');
            Route::delete('note/delete/{note_id}', 'destroy');
        });
    });
});



