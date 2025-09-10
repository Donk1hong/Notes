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


Route::apiResources([
    'users' => UsersController::class,
    'notes' => NotesController::class,
]);
