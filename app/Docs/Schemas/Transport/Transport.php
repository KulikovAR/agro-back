<?php

namespace App\Docs\Schemas\Transport;

/**
 * @OA\Schema(
 *      title="Transport",
 *      description="Transport model",
 *      @OA\Property(property="id", type="string", format="uuid", example="9b519d54-ac2b-4aa3-857c-ff41a3b3e6b3"),
 *      @OA\Property(property="driver", type="object",
 *          @OA\Property(property="id", type="string", format="uuid", example="9b519d54-9806-4309-bb3e-0462a96ac9ed"),
 *          @OA\Property(property="user", type="object",
 *              @OA\Property(property="id", type="string", format="uuid", example="9b519d54-8747-4b84-8b82-44e2cfa8dc63"),
 *              @OA\Property(property="phone_number", type="string", example="+7000510238"),
 *              @OA\Property(property="code", type="string", example="836"),
 *              @OA\Property(property="code_hash", type="string", example="$2y$12$ZH2B1ILNMZf8SX8v58pWROfM340JbuYAWuN9NzXW02NJaxQKFzSzO"),
 *              @OA\Property(property="phone_verified_at", type="string", format="date-time", example="2024-02-12T14:32:21.000000Z"),
 *          ),
 *          @OA\Property(property="company_id", type="string", format="uuid", example="27f7468a-f4a6-4e3f-bfa1-b621c7a4d17e"),
 *          @OA\Property(property="is_active", type="integer", example=1),
 *      ),
 *      @OA\Property(property="type", type="integer", example=1),
 *      @OA\Property(property="number", type="string", example="aaa723c"),
 *      @OA\Property(property="model", type="string", example="Moskvich"),
 *      @OA\Property(property="description", type="string", example="Tempora."),
 *      @OA\Property(property="free", type="integer", example=1),
 *      @OA\Property(property="is_active", type="integer", example=1),
 *      @OA\Property(property="volume_cm", type="string", example="303"),
 *      @OA\Property(property="capacity", type="integer", example=5713029),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-12T14:32:22.000000Z"),
 * )
 */
class Transport
{

}
