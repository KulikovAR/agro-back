<?php

namespace App\Docs\TransportType;

class TransportTypeController
{
    /**
     * @OA\Get(
     *     path="/transport/manual/types",
     *     summary="Весь список типов транспорта",
     *     tags={"TransportType"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 description="Status of the response",
     *                 example="OK"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="Additional message if any",
     *                 example=""
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 description="Весь список типов транспорта",
     *
     *                 @OA\Items(
     *                     type="object",
     *
     *                     @OA\Property(property="id", type="string", example="9b5796d5-43fe-435e-8fc0-0e679eb87a96"),
     *                     @OA\Property(property="title", type="string", example="KAMAZ"),
     *                     @OA\Property(property="type", type="string", example="Fura"),
     *
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index() {}
}
