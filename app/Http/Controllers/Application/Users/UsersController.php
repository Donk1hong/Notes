<?php

namespace App\Http\Controllers\Application\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ForgotPassword;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Http\Requests\Users\ResetPassword;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class UsersController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('login.form')->with('success', 'Регистрация прошла успешна');
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->validated();

        $remember = $request->filled('remember_token');

        $userExists = User::where('email', $credentials['email'])->exists();

        if (!$userExists) {
            return redirect()->back()
                ->withErrors(['email' => 'Пользователь с такой почтой не найден'])
                ->withInput();
        }

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()
                ->withErrors(['password' => 'Неверный пароль'])
                ->withInput();
        }
    }

    public function logout() {

        Auth::logout();

        return redirect()->route('home');
    }

    public function forgotPassword(ForgotPassword $request)
    {
        $status = Password::sendResetLink(
            $request->validated()
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __('auth.email')]);

    }

    public function resetPassword(ResetPassword $request) {

        $status = Password::reset(
            $request->validated(),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.form')->with('status', __('Пароль успешно сброшен'))
            : back()->withErrors(['email' => [__('auth.email')]]);
    }
}


