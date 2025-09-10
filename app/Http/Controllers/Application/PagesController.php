<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home() {
        $data = [];

        if (auth()->check()) {
            $data = auth()->user()->notes;
        }

        return view('pages.main', ['notes' => $data]);
    }

    public function indexRegister() {
        return view('pages.registration.register');
    }

    public function indexLogin() {
        return view('pages.auth.login');
    }

    public function indexForgotPassword() {
        return view('pages.auth.forgot-password');
    }

    public function indexResetPassword(string $token) {;
        return view('pages.auth.reset-password', ['token' => $token]);
    }
}
