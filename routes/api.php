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
                Route::post('register', 'register')->name('user.register');
                Route::post('login', 'login')->name('user.login');
                Route::post('forgot/password', 'forgotPassword')->name('user.forgot.password');
            });
            Route::get('user', 'show')->name('user.show');
            Route::post('logout', 'logout')->name('user.logout');
        });

    });

    Route::controller(NotesController::class)->prefix('user')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('notes', 'index')->name('user.notes');
            Route::post('note/create', 'store')->name('note.create');
            Route::patch('note/update/{note_id}', 'update')->name('note.update');
            Route::delete('note/delete/{note_id}', 'destroy')->name('note.delete');
        });
    });
});



