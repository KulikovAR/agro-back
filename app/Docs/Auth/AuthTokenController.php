<?php

namespace App\Docs\Auth;

class AuthTokenController
{
    /**
     * @OA\Post(
     *     path="/login",
     *     summary="Авторизация пользователя",
     *     tags={"Login"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Тело запроса",
     *         @OA\JsonContent(
     *             required={"phone_number"},
     *             @OA\Property(property="phone_number", type="string", example="79202149572", description="Номер телефона пользователя"),
     *         ),
     *     ),
        *     @OA\Response(
     *         response=200,
     *         description="Успешное подтверждение авторизации",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="login.verify_phone"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="string", example="9b43aeb0-7b99-4266-a3fa-6ff7fa1dc644"),
     *                     @OA\Property(property="phone_number", type="string", example="79202149572"),
     *                     @OA\Property(property="code", type="string", example="44417"),
     *                     @OA\Property(property="code_hash", type="string", example="$2y$12$iUP5sPOCOkkE23o..PTiTeUfDk6pogGjK2ItLgy1GukqgXa5rfJpW"),
     *                     @OA\Property(property="phone_verified_at", type="string", format="date-time", example="2024-02-05T16:20:13.000000Z"),
     *                 ),
     *                 @OA\Property(property="token", type="string", example="5|R4fHMZZw5ODsWLwZQjtm4NzubiUv0uGpA7w6ll8z9a086e0c"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неудачная авторизация",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="Unauthorized"),
     *             @OA\Property(property="message", type="string", example="Invalid credentials"),
     *         ),
     *     ),
     * )
     */
    public function store()
    {
    }

    /**
     *
     * @OA\Delete(
     *     path="/logout",
     *     operationId="logout",
     *     tags={"Login"},
     *     summary="Logout",
     *     security={{"api": {}}},
     *     @OA\Response(
     *          response="200",
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                @OA\Property(property="status", type="string", example="OK"),
     *                @OA\Property(property="message", type="string", example=""),
     *                @OA\Property(property="data", example="[]"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          ref="#/components/responses/401"
     *      ),
     *)
     */
    public function destroy()
    {
    }

    /**
     * @OA\Post(
     *     path="/login/verification",
     *     summary="Подтверждение авторизации пользователя",
     *     tags={"Login"},
     * @OA\RequestBody(
     *         required=true,
     *         description="Verification data",
     *         @OA\JsonContent(
     *             required={"phone_number", "code"},
     *             @OA\Property(property="phone_number", type="string", description="User's phone number"),
     *             @OA\Property(property="code", type="string", description="Verification code"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешное подтверждение авторизации",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="login.verify_phone"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="string", example="9b43aeb0-7b99-4266-a3fa-6ff7fa1dc644"),
     *                     @OA\Property(property="phone_number", type="string", example="79202149572"),
     *                     @OA\Property(property="code", type="string", example="44417"),
     *                     @OA\Property(property="code_hash", type="string", example="$2y$12$iUP5sPOCOkkE23o..PTiTeUfDk6pogGjK2ItLgy1GukqgXa5rfJpW"),
     *                     @OA\Property(property="phone_verified_at", type="string", format="date-time", example="2024-02-05T16:20:13.000000Z"),
     *                 ),
     *                 @OA\Property(property="token", type="string", example="5|R4fHMZZw5ODsWLwZQjtm4NzubiUv0uGpA7w6ll8z9a086e0c"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неудачное подтверждение авторизации",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="Unauthorized"),
     *             @OA\Property(property="message", type="string", example="Invalid verification code"),
     *         ),
     *     ),
     * )
     */
    public function verification()
    {
    }
}
