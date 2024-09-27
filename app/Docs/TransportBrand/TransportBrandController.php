<?php

namespace App\Docs\TransportBrand;

class TransportBrandController
{
    /**
     * @OA\Get(
     *     path="/transport/manual/brands",
     *     summary="Весь список брендов транспорта",
     *     tags={"TransportBrand"},
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
     *                 description="Весь список брендов транспорта",
     *
     *                 @OA\Items(
     *                     type="object",
     *
     *                     @OA\Property(property="id", type="string", example="9b5796d5-43fe-435e-8fc0-0e679eb87a96"),
     *                     @OA\Property(property="title", type="string", example="KAMAZ"),
     *                     @OA\Property(property="image", type="string", example="https://via.placeholder.com/640x480.png/009966?text=suscipit"),
     *
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index()
    {
    }
}
