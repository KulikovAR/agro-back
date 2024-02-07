<?php

namespace App\Docs\Schemas\Product;


/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product model",
 *     @OA\Xml(
 *         name="Product"
 *     )
 * )
 */
class Product
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
    private $name;
    /**
     *     @OA\Property(
     *         property="class",
     *         type="string",
     *         description="Класс или категория продукта",
     *         example="3-й"
     *     ),
     * @var string
     */
    private $class;
    /**
     *     @OA\Property(
     *         property="attr",
     *         type="string",
     *         nullable=true,
     *         description="Атрибуты продукта",
     *         example="15,3"
     *     ),
     * @var string
     */
    private $attr;

    /**
     *     @OA\Property(
     *         property="company",
     *         type="string",
     *         description="Компания, связанная с продуктом",
     *         example="Компания"
     *     ),
     * @var string
     */
    private $company;

    /**
     *     @OA\Property(
     *         property="price",
     *         type="number",
     *         description="Цена продукта",
     *         example=14.8
     *     ),
     * @var string
     */
    private $price;

    /**
     *     @OA\Property(
     *         property="type",
     *         type="integer",
     *         description="Тип продукта",
     *         example=1
     *     ),
     * @var string
     */
    private $type;

    /**
     *     @OA\Property(
     *         property="gluten",
     *         type="string",
     *         nullable=true,
     *         description="Содержание глютена",
     *         example="23"
     *     ),
     * @var string
     */
    private $gluten;

    /**
     *     @OA\Property(
     *         property="idk",
     *         type="string",
     *         nullable=true,
     *         description="Идентификатор (IDK), связанный с продуктом",
     *         example="90"
     *     ),
     * @var string
     */
    private $idk;

    /**
     *     @OA\Property(
     *         property="chp",
     *         type="string",
     *         nullable=true,
     *         description="Значение CHP (Combined Heat and Power)",
     *         example="220"
     *     ),
     * @var string
     */
    private $chp;


    /**
     *     @OA\Property(
     *         property="nature",
     *         type="string",
     *         description="Значение природы продукта",
     *         example="760"
     *     ),
     * @var string
     */
    private $nature;

    /**
     *     @OA\Property(
     *         property="humidity",
     *         type="string",
     *         description="Процент влажности продукта",
     *         example="14%"
     *     ),
     * @var string
     */
    private $humidity;

    /**
     *     @OA\Property(
     *         property="weed_impurity",
     *         type="string",
     *         nullable=true,
     *         description="Информация о сорняках в продукте",
     *         example=null
     *     ),
     * @var string
     */
    private $weed_impurity;

    /**
     *     @OA\Property(
     *         property="chinch",
     *         type="string",
     *         nullable=true,
     *         description="Клопы",
     *         example="2"
     *     ),
     * @var string
     */
    private $chinch;


    /**
     *     @OA\Property(
     *         property="exporter",
     *         type="string",
     *         description="Компания-экспортер, связанная с продуктом",
     *         example="Экспортёр"
     *     ),
     * @var string
     */
    private $exporter;

    /**
     *     @OA\Property(
     *         property="parser",
     *         type="integer",
     *         description="Идентификатор парсера",
     *         example=1
     *     ),
     * @var string
     */
    private $parser;

    /**
     *     @OA\Property(
     *         property="created_at",
     *         type="string",
     *         description="Метка времени создания записи о продукте",
     *         example="2024-02-05T10:59:44.000000Z"
     *     ),
     * @var string
     */
    private $created_at;

    /**
     *     @OA\Property(
     *         property="updated_at",
     *         type="string",
     *         description="Метка времени последнего обновления записи о продукте",
     *         example="2024-02-05T10:59:44.000000Z"
     *     ),
     * @var string
     */
    private $updated_at;


    /**
     *     @OA\Property(
     *         property="logs",
     *         type="object",
     *         description="Информация о журнале для продукта, включая дату и соответствующие данные",
     *         @OA\AdditionalProperties(
     *             type="number",
     *             example=0
     *         )
     *     )
     * )
     * @var string
     */
    private $logs;
}
