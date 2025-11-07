<?php

namespace App\Http\Controllers\Api\v1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiRequests;
use App\Http\Requests\Api\Users\EditUserRequest;
use App\Http\Requests\Api\Users\ForgotPasswordRequest;
use App\Http\Requests\Api\Users\LoginUserRequest;
use App\Http\Requests\Api\Users\RegisterUserRequest;
use App\Http\Requests\Api\Users\ResetPasswordRequest;
use App\Http\Resources\Notes\MinifiedNotesResource;
use App\Http\Resources\User\UsersResource;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;

class UsersController extends Controller
{
        /**
     * @OA\Post(
     *   path="/api/v1/auth/register",
     *   operationId="Auth_Register",
     *   summary="Регистрация",
     *   tags={"Users"},
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/RegisterRequest")),
     *   @OA\Response(
     *     response=201,
     *     description="Создано",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string", example="Регистрация прошла успешна."),
     *       @OA\Property(property="data", ref="#/components/schemas/User"),
     *       @OA\Property(property="token", type="string", example="1|abc...")
     *     )
     *   ),
     *   @OA\Response(response=422, description="Валидация")
     * )
     */
    public function register(RegisterUserRequest $request) {
        $data = $request->validated();

        $user = User::create([
            'id' => $request->input('id'),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Регистрация прошла успешна.',
            'data' => new UsersResource($user),
            'token' => $token,
        ], 201);
    }

     /**
     * @OA\Post(
     *   path="/api/v1/auth/login",
     *   operationId="Auth_Login",
     *   summary="Логин",
     *   tags={"Users"},
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/LoginRequest")),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Авторизация прошла успешно."),
     *       @OA\Property(property="token", type="string", example="1|abc...")
     *     )
     *   ),
     *   @OA\Response(response=422, description="Валидация")
     * )
     */
    public function login(LoginUserRequest $request) {
        $data = $request->validated();

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('api_token')->plainTextToken;

            return response()->json([
                'message' => 'Авторизация прошла успешно.',
                'token' => $token,
            ], 201);
        } else {
            throw ValidationException::withMessages([
                'message' => 'Пароль неверный.',
            ]);
        }
    }

     /**
     * @OA@Get(
     *   path="/api/v1/user",
     *   operationId="User_Show",
     *   summary="Профиль + заметки",
     *   tags={"Users"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="user", ref="#/components/schemas/User"),
     *       @OA\Property(property="notes", type="array", @OA\Items(ref="#/components/schemas/Note"))
     *     )
     *   ),
     *   @OA\Response(response=401, description="Не авторизован")
     * )
     */
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
            throw ValidationException::withMessages([
                'message' => 'У вас пока нету заметок.'
            ]);
        } else {
            return response()->json([
              'message' => 'Для просмотра аккаунта необходимо войти.'
            ], 401);
        }
    }

    /**
     * @OA\Patch(
     *   path="/api/v1/user/password",
     *   operationId="User_UpdatePassword",
     *   summary="Смена пароля",
     *   tags={"Users"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/EditPasswordRequest")),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Не авторизован"),
     *   @OA\Response(response=422, description="Валидация")
     * )
     */
    public function edit(EditUserRequest $request) {
        $data = $request->validated();

        $user = auth()->user();

        $user->update(['password' => Hash::make($data['password'])]);

        $user->tokens()->delete();

        return response()->json([
            'message' => 'Пароль успешно сброшен.'
        ]);
    }

    /**
     * @OA\Post(
     *   path="/api/v1/auth/forgot-password",
     *   operationId="Auth_ForgotPassword",
     *   summary="Отправка письма для сброса",
     *   tags={"Users"},
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ForgotPasswordRequest")),
     *   @OA\Response(response=201, description="Ссылка отправлена"),
     *   @OA\Response(response=422, description="Валидация")
     * )
     */
    public function forgotPassword(ForgotPasswordRequest $request) {
        $status = Password::sendResetLink($request->only('email'));

        return response()->json([
            'message' => __($status),
        ], $status === Password::RESET_LINK_SENT ? 201 : 422);
    }

     /**
     * @OA\Post(
     *   path="/api/v1/auth/reset-password",
     *   operationId="Auth_ResetPassword",
     *   summary="Сброс пароля по токену",
     *   tags={"Users"},
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ResetPasswordRequest")),
     *   @OA\Response(response=200, description="Пароль сброшен"),
     *   @OA\Response(response=422, description="Валидация")
     * )
     */
    public function resetPassword(ResetPasswordRequest $request) {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return response()->json([
            'message' => $status === Password::PASSWORD_RESET
                ? with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)])
        ]);
    }

   /**
     * @OA\Post(
     *   path="/api/v1/auth/logout",
     *   operationId="Auth_Logout",
     *   summary="Выход (отзыв токена)",
     *   tags={"Users"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Не авторизован")
     * )
     */
    public function logout(ApiRequests $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Вы вышли с аккаунта.'
        ]);
    }

    /**
     * @OA\Delete(
     *   path="/api/v1/user",
     *   operationId="User_Delete",
     *   summary="Удалить аккаунт",
     *   tags={"Users"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Не авторизован")
     * )
     */
    public function delete() {
        $user = auth()->user();

        $user->currentAccessToken()->delete();
        $user->delete();

        return response()->json([
            'message' => 'Пользователь успешно удалён'
        ]);
    }
}
