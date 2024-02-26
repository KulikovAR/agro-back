<?php

namespace App\Docs\Schemas\TransportBrand;


/**
 * @OA\Schema(
 *     title="TransportBrand",
 *     description="TransportBrand model",
 *     @OA\Xml(
 *         name="TransportBrand"
 *     )
 * )
 */
class TransportBrand
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Id магазина",
     *     format="string",
     *     example="9a77fec2-b5e1-4d58-99b8-6f45fe8f11ff"
     * )
     *
     * @var string
     */
    private $id;
    /**
     * @OA\Property(
     *         property="name",
     *         type="string",
     *         description="Название продукта",
     *         example="Ячмень"
     *     ),
     *
     * @var string
     */
    private $title;
    /**
     *     @OA\Property(
     *         property="class",
     *         type="title",
     *         description="Название",
     *         example="KAMAZ"
     *     ),
     * @var string
     */
    private $image;
    /**
     *     @OA\Property(
     *         property="attr",
     *         type="string",
     *         nullable=true,
     *         description="Изображение",
     *         example="https://via.placeholder.com/640x480.png/009966?text=suscipit"
     *     ),
     * @var string
     */

}
