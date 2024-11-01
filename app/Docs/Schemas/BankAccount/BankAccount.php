<?php

namespace App\Docs\Schemas\BankAccount;

/**
 * @OA\Schema(
 *      schema="BankAccount",
 *      title="BankAccount",
 *      description="Bank Account model",
 *      required={"id", "bik", "title", "number", "correspondent_number", "is_main", "user_id", "created_at", "updated_at"},
 *
 *      @OA\Property(
 *          property="id",
 *          type="string",
 *          format="uuid",
 *          example="9baaa8c9-f418-47ab-a542-d84b58107c77"
 *      ),
 *      @OA\Property(
 *          property="bik",
 *          type="string",
 *          example="WLIJICW33Q1"
 *      ),
 *      @OA\Property(
 *          property="title",
 *          type="string",
 *          example="sint"
 *      ),
 *      @OA\Property(
 *          property="number",
 *          type="string",
 *          example="WF"
 *      ),
 *      @OA\Property(
 *          property="correspondent_number",
 *          type="string",
 *          example="4916590596703657"
 *      ),
 *      @OA\Property(
 *          property="is_main",
 *          type="integer",
 *          example=1
 *      ),
 *      @OA\Property(
 *          property="user_id",
 *          type="string",
 *          format="uuid",
 *          example="9baaa8c9-c2b7-44a5-9135-7aca6ed412fe"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          type="string",
 *          format="date-time",
 *          example="2024-03-27T20:53:05.000000Z"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          type="string",
 *          format="date-time",
 *          example="2024-03-27T20:53:05.000000Z"
 *      )
 * )
 */
class BankAccount {}
