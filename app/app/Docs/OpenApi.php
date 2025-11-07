<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Notes API",
 *   description="Документация API (Laravel + Sanctum)"
 * )
 * @OA\Server(url="/", description="Local")
 *
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="JWT"
 * )
 *
 * @OA\Schema(
 *   schema="MessageResponse",
 *   type="object",
 *   @OA\Property(property="message", type="string", example="ОК")
 * )
 *
 * @OA\Schema(
 *   schema="ValidationError",
 *   type="object",
 *   @OA\Property(
 *     property="errors",
 *     type="object",
 *     additionalProperties=@OA\Schema(
 *       type="array",
 *       @OA\Items(type="string", example="Поле обязательно для заполнения.")
 *     )
 *   )
 * )
 *
 * @OA\Schema(
 *   schema="Note",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="title", type="string", example="Моя заметка"),
 *   @OA\Property(property="category", type="string", example="work"),
 *   @OA\Property(property="description", type="string", example="Текст заметки"),
 *   @OA\Property(property="created_at", type="string", format="date-time"),
 *   @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *   schema="NoteCreateRequest",
 *   type="object",
 *   required={"title","category","description"},
 *   @OA\Property(property="title", type="string", maxLength=100),
 *   @OA\Property(property="category", type="string"),
 *   @OA\Property(property="description", type="string", maxLength=355)
 * )
 *
 * @OA\Schema(
 *   schema="NoteUpdateRequest",
 *   type="object",
 *   @OA\Property(property="title", type="string", maxLength=100),
 *   @OA\Property(property="category", type="string"),
 *   @OA\Property(property="description", type="string", maxLength=355)
 * )
 *
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=10),
 *   @OA\Property(property="email", type="string", example="user@example.com")
 * )
 *
 * @OA\Schema(
 *   schema="RegisterRequest",
 *   type="object",
 *   required={"email","password","password_confirmation"},
 *   @OA\Property(property="email", type="string", format="email"),
 *   @OA\Property(property="password", type="string", minLength=6),
 *   @OA\Property(property="password_confirmation", type="string", minLength=6)
 * )
 *
 * @OA\Schema(
 *   schema="LoginRequest",
 *   type="object",
 *   required={"email","password"},
 *   @OA\Property(property="email", type="string", format="email"),
 *   @OA\Property(property="password", type="string", minLength=6)
 * )
 *
 * @OA\Schema(
 *   schema="EditPasswordRequest",
 *   type="object",
 *   required={"password","password_confirmation"},
 *   @OA\Property(property="password", type="string", minLength=6),
 *   @OA\Property(property="password_confirmation", type="string", minLength=6)
 * )
 *
 * @OA\Schema(
 *   schema="ForgotPasswordRequest",
 *   type="object",
 *   required={"email"},
 *   @OA\Property(property="email", type="string", format="email")
 * )
 *
 * @OA\Schema(
 *   schema="ResetPasswordRequest",
 *   type="object",
 *   required={"email","password","password_confirmation","token"},
 *   @OA\Property(property="email", type="string", format="email"),
 *   @OA\Property(property="password", type="string", minLength=6),
 *   @OA\Property(property="password_confirmation", type="string", minLength=6),
 *   @OA\Property(property="token", type="string")
 * )
 */
class OpenApi {}
