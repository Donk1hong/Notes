<?php

namespace App\Http\Controllers\Api\v1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiRequests;
use App\Http\Requests\Api\Users\ForgotPassword;
use App\Http\Requests\Api\Users\LoginUserRequest;
use App\Http\Requests\Api\Users\RegisterUserRequest;
use App\Http\Resources\Notes\MinifiedNotesResource;
use App\Http\Resources\User\UsersResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class UsersController extends Controller
{
    public function register(RegisterUserRequest $request) {

         $user = $request->validated();

         $user_created = User::create([
            'id' => $request->input('id'),
            'email' => $user['email'],
            'password' => Hash::make($user['password'])
        ]);

         return response()->json([
             'message' => 'Регистрация прошла успешна',
             'data' => new UsersResource($user_created)
        ], 201);


    }
    public function login(LoginUserRequest $request) {

        $user = auth()->attempt($request->validated());

        if (!$user) {
            return response()->json(['message' => 'Вы не авторизованны'], 401);
        }

        $token = auth()->user()->createToken('api_token')->plainTextToken;

        return [
            'message' => 'Авторизация прошла успешно',
            'token' => $token,
        ];
    }
    public function show() {

        $user = auth()->user();

        $notes = $user->notes()->get();

       if (auth()->check()) {
            if ($user->notes()->exists()) {
                 return response()->json([
                     'user' => new UsersResource($user),
                     'notes' => MinifiedNotesResource::collection($notes)
                 ]);
            }
            return response()->json([
                    'user' => new UsersResource($user),
                    'message' => 'У вас пока нет заметок'
                ]);
        } else {
            return response()->json([
              'message' => 'Для просмотра аккаунта необходимо войти'
            ], 401);
        }
    }

    public function forgotPassword(ForgotPassword $request) {
        $status = Password::sendResetLink(
            $request->validated()
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json([
                'status' => __($status)
            ], 201)
            : response()->json([
                'status' => __($status)
            ], 400);
    }

    public function logout(ApiRequests $request) {

        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Вы вышли с аккаунта'
        ]);
    }
}
