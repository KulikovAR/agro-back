<?php

namespace App\Docs\BankAccount;

class BankAccountController
{

    /**
     * @OA\Get(
     *     path="/bank-accounts/",
     *     summary="Get all bank accounts of a user",
     *     description="Получение перевозчиком своих счетов",
     *     tags={"Bank Accounts"},
     *          security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Bank accounts retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Все банковские счета пользователя получены"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/BankAccount")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     * *         response=404,
     * *         description="Not Found",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Запись не найдена")
     * *         )
     * *     ),
     * *     @OA\Response(
     * *         response=401,
     * *         description="Unauthorized",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Пользователь не авторизован")
     * *         )
     * *     )
     * )
     */
    public function index()
    {
    }


    /**
     * @OA\Get(
     *     path="/bank-accounts/{id}",
     *     summary="Get a bank account by ID",
     *     description="Получение перевозчиком своего счёта",
     *     tags={"Bank Accounts"},
     *          security={{"bearerAuth": {}}},
     *          @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the bank account",
     *          @OA\Schema(
     *              type="string",
     *              format="uuid"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Bank account retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Банковский счёт пользователя получен"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="string", format="uuid", example="9baaa8c9-f418-47ab-a542-d84b58107c77"),
     *                 @OA\Property(property="bik", type="string", example="WLIJICW33Q1"),
     *                 @OA\Property(property="title", type="string", example="sint"),
     *                 @OA\Property(property="number", type="string", example="WF"),
     *                 @OA\Property(property="correspondent_number", type="string", example="4916590596703657"),
     *                 @OA\Property(property="is_main", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="string", format="uuid", example="9baaa8c9-c2b7-44a5-9135-7aca6ed412fe"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-03-27T20:53:05.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-03-27T20:53:05.000000Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     * *         response=404,
     * *         description="Not Found",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Запись не найдена")
     * *         )
     * *     ),
     * *     @OA\Response(
     * *         response=401,
     * *         description="Unauthorized",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Пользователь не авторизован")
     * *         )
     * *     )
     * )
     */
    public function show()
    {
    }

    /**
     * @OA\Post(
     *     path="/bank-accounts/",
     *     summary="Create a new bank account",
     *     description="Create a new bank account for a user.",
     *     tags={"Bank Accounts"},
     *          security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Bank account details",
     *         @OA\JsonContent(
     *             required={"is_main", "bik", "correspondent_number", "title", "number"},
     *             @OA\Property(property="is_main", type="string", example="1"),
     *             @OA\Property(property="bik", type="string", example="2151235123"),
     *             @OA\Property(property="correspondent_number", type="string", example="5916590596703657"),
     *             @OA\Property(property="title", type="string", example="CHERNOZEM"),
     *             @OA\Property(property="number", type="string", example="21516122")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Bank account created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Банковский счёт создан"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="user_id", type="string", format="uuid", example="9baaa8c9-c2b7-44a5-9135-7aca6ed412fe"),
     *                 @OA\Property(property="is_main", type="string", example="1"),
     *                 @OA\Property(property="bik", type="string", example="2151235123"),
     *                 @OA\Property(property="correspondent_number", type="string", example="5916590596703657"),
     *                 @OA\Property(property="title", type="string", example="CHERNOZEM"),
     *                 @OA\Property(property="number", type="string", example="21516122"),
     *                 @OA\Property(property="id", type="string", format="uuid", example="9babed86-88e7-4977-9be8-98b35791bdaa"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-03-28T12:01:07.000000Z"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-03-28T12:01:07.000000Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     * *         response=404,
     * *         description="Not Found",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Запись не найдена")
     * *         )
     * *     ),
     * *     @OA\Response(
     * *         response=401,
     * *         description="Unauthorized",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Пользователь не авторизован")
     * *         )
     * *     )
     * )
     */
    public function create()
    {
    }


    /**
     * @OA\Put(
     *     path="/bank-accounts/{id}",
     *     summary="Update a bank account",
     *     description="Update an existing bank account for a user.",
     *     tags={"Bank Accounts"},
     *          security={{"bearerAuth": {}}},
     *          @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the bank account to delete",
     *          @OA\Schema(
     *              type="string",
     *              format="uuid"
     *          )
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Bank account details",
     *         @OA\JsonContent(
     *             @OA\Property(property="is_main", type="string"),
     *             @OA\Property(property="bik", type="string"),
     *             @OA\Property(property="correspondent_number", type="string"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="number", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bank account updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Банковский счёт обновлён"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="user_id", type="string", format="uuid"),
     *                 @OA\Property(property="is_main", type="string"),
     *                 @OA\Property(property="bik", type="string"),
     *                 @OA\Property(property="correspondent_number", type="string"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="number", type="string"),
     *                 @OA\Property(property="id", type="string", format="uuid"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     * *         response=404,
     * *         description="Not Found",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Запись не найдена")
     * *         )
     * *     ),
     * *     @OA\Response(
     * *         response=401,
     * *         description="Unauthorized",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Пользователь не авторизован")
     * *         )
     * *     )
     * )
     */
    public function update()
    {
    }

    /**
     * @OA\Delete(
     *     path="/bank-accounts/{id}",
     *     summary="Delete a bank account",
     *     description="Delete an existing bank account by its ID.",
     *     tags={"Bank Accounts"},
     *          security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the bank account to delete",
     *         @OA\Schema(
     *             type="string",
     *             format="uuid"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bank account deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Банковский счёт удалён"),
     *             @OA\Property(property="data", type="array", @OA\Items())
     *         )
     *     ),
     *     @OA\Response(
     * *         response=404,
     * *         description="Not Found",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Запись не найдена")
     * *         )
     * *     ),
     * *     @OA\Response(
     * *         response=401,
     * *         description="Unauthorized",
     * *         @OA\JsonContent(
     * *             @OA\Property(property="message", type="string", example="Пользователь не авторизован")
     * *         )
     * *     )
     * )
     */
    public function delete()
    {
    }
}
