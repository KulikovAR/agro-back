<?php

namespace App\Docs\SignMe;

class SignMe
{
    /**
     * @OA\Post(
     *     path="/sign-me",
     *     summary="Sign a document",
     *          tags={"SignMe"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="path",
     *                 type="string",
     *                 description="path to file"
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="OK"),
     *                     @OA\Property(property="message", type="string", example="https://test.sign.me/signapi/sjson/320186/df7977a1763a0a056a670913d96b9904"),
     *                     @OA\Property(property="data", type="array", @OA\Items())
     *                 ),
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="OK"),
     *                     @OA\Property(property="message", type="string", example="Произошла ошибка, обратитесь к администратору"),
     *                     @OA\Property(property="data", type="array", @OA\Items())
     *                 ),
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="OK"),
     *                     @OA\Property(property="message", type="string", example="Произошла ошибка при подписание документа"),
     *                     @OA\Property(property="data", type="array", @OA\Items())
     *                 ),
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="OK"),
     *                     @OA\Property(property="message", type="string", example="Документ успешно подписан"),
     *                     @OA\Property(property="data", type="array", @OA\Items())
     *                 ),
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="OK"),
     *                     @OA\Property(property="message", type="string", example="Ожидает подтверждения регистрации в Sign.me"),
     *                     @OA\Property(property="data", type="array", @OA\Items())
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Resource not found")
     *         )
     *     )
     * )
     */
    public function signature()
    {
        // Логика обработки запроса для подписания документа
    }
}
