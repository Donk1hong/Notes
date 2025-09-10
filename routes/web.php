<?php

use App\Http\Controllers\Application\Notes\NotesController;
use App\Http\Controllers\Application\PagesController;
use App\Http\Controllers\Application\Users\UsersController;
use Illuminate\Support\Facades\Route;


Route::controller(PagesController::class)->middleware('guest')->group(function () {
    Route::get('/', 'home')->name('home')->withoutMiddleware('guest');
    Route::get('/register', 'indexRegister')->name('registration.form');
    Route::get('/login', 'indexLogin')->name('login.form');
    Route::get('/forgot/password', 'indexForgotPassword')->name('forgot-password.form');
    Route::get('/forgot/password/reset/{token}', 'indexResetPassword')->name('reset-password.form');
});

Route::controller(UsersController::class)->middleware('guest')->group(function () {
   Route::post('/register', 'register')->name('registration.action');
   Route::post('/login', 'login')->name('login.action');
   Route::post('/logout', 'logout')->name('logout.action')
       ->withoutMiddleware('guest')
       ->middleware('auth');
   Route::post('/forgot/password', 'forgotPassword')->name('forgot-password.action');
   Route::post('/forgot/password/reset/{token}', 'resetPassword')->name('password.reset');
});

Route::controller(NotesController::class)->middleware('auth')->group(function () {
    Route::post('/create', 'create')->name('notes.create');
    Route::delete('/delete{note}', 'delete')->name('notes.delete');
    Route::patch('/update{note}', 'edit')->name('notes.update');
    Route::post('/search', 'search')->name('notes.search');
});
