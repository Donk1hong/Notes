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
        Route::post('login', 'login')->name('user.login');
        Route::post('register', 'register')->name('user.register');
        Route::post('forgot/password', 'forgotPassword')->name('forgot.password');
        Route::post('reset/password', 'resetPassword')->name('password.reset');

        Route::middleware('auth:sanctum')->prefix('user')->group(function () {
            Route::patch('edit', 'edit')->name('user.edit');
            Route::get('me', 'show')->name('user.show');
            Route::post('logout', 'logout')->name('user.logout');
            Route::delete('delete', 'delete')->name('user.delete');
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



