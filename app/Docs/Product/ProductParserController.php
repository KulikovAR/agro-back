<?php

namespace App\Docs\Product;

class ProductParserController
{
    /**
     * @OA\Get(
     *     path="/products-parser/",
     *     summary="Get list of products from the parser",
     *     tags={"Products"},
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
     *                 description="List of products",
     *
     *                 @OA\Items(
     *                     type="object",
     *
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Ячмень"),
     *                     @OA\Property(property="class", type="string", example="3-й"),
     *                     @OA\Property(property="attr", type="string", nullable=true),
     *                     @OA\Property(property="company", type="string", example="Компания"),
     *                     @OA\Property(property="price", type="number", example=0),
     *                     @OA\Property(property="type", type="integer", example=2),
     *                     @OA\Property(property="gluten", type="string", nullable=true),
     *                     @OA\Property(property="idk", type="string", nullable=true),
     *                     @OA\Property(property="chp", type="string", nullable=true),
     *                     @OA\Property(property="nature", type="string", example="580"),
     *                     @OA\Property(property="humidity", type="string", example="14%"),
     *                     @OA\Property(property="weed_impurity", type="string", nullable=true),
     *                     @OA\Property(property="chinch", type="string", nullable=true),
     *                     @OA\Property(property="exporter", type="string", example="Экспортёр"),
     *                     @OA\Property(property="parser", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", example="2024-02-05T10:59:44.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", example="2024-02-05T10:59:44.000000Z"),
     *                     @OA\Property(
     *                         property="logs",
     *                         type="object",
     *                         description="Information about product logs",
     *
     *                         @OA\AdditionalProperties(type="number", example=0)
     *                     ),
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index()
    {
    }

    /**
     * @OA\Get(
     *     path="/products-parser/get-filters",
     *     summary="Получить фильтры для продуктов",
     *     tags={"Products"},
     *     description="Метод предоставляет фильтры для продуктов на основе параметров.",
     *
     *     @OA\Parameter(
     *         name="types[]",
     *         in="query",
     *         description="Массив с параметрами фильтрации",
     *         required=true,
     *         style="form",
     *         explode="true",
     *
     *         @OA\Schema(
     *             type="array",
     *
     *             @OA\Items(type="string", example="name")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="array",
     *
     *                     @OA\Items(
     *                         type="object",
     *
     *                         @OA\Property(property="label", type="string"),
     *                         @OA\Property(property="value", type="string")
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function getProductFilter()
    {
    }
}
