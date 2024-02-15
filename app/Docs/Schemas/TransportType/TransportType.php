<?php

namespace App\Docs\Schemas\TransportType;


/**
 * @OA\Schema(
 *     title="TransportType",
 *     description="TransportType model",
 *     @OA\Xml(
 *         name="TransportType"
 *     )
 * )
 */
class TransportType
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Id",
     *     format="string",
     *     example="9a77fec2-b5e1-4d58-99b8-6f45fe8f11ff"
     * )
     *
     * @var string
     */
    private $id;
    /**
     *     @OA\Property(
     *         property="class",
     *         type="title",
     *         description="Название",
     *         example="KAMAZ"
     *     ),
     * @var string
     */
    private $title;

    private $type;
    /**
     *     @OA\Property(
     *         property="type",
     *         type="string",
     *         nullable=true,
     *         description="Тип",
     *         example="Fura"
     *     ),
     * @var string
     */
}
