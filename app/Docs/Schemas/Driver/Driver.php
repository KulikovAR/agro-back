<?php

namespace App\Docs\Schemas\Driver;

/**
 * @OA\Schema(
 *      title="Driver",
 *      description="Driver model",
 *
 *      @OA\Property(property="id", type="string", format="uuid", example="9b519d54-9806-4309-bb3e-0462a96ac9ed"),
 *      @OA\Property(property="user", type="object",
 *          @OA\Property(property="id", type="string", format="uuid", example="9b519d54-8747-4b84-8b82-44e2cfa8dc63"),
 *          @OA\Property(property="phone_number", type="string", example="+7000510238"),
 *          @OA\Property(property="code", type="string", example="836"),
 *          @OA\Property(property="code_hash", type="string", example="$2y$12$ZH2B1ILNMZf8SX8v58pWROfM340JbuYAWuN9NzXW02NJaxQKFzSzO"),
 *          @OA\Property(property="phone_verified_at", type="string", format="date-time", example="2024-02-12T14:32:21.000000Z"),
 *      ),
 *      @OA\Property(property="is_active", type="integer", example=1),
 *      @OA\Property(property="company_id", type="string", format="uuid", example="27f7468a-f4a6-4e3f-bfa1-b621c7a4d17e"),
 * )
 */
class Driver {}
