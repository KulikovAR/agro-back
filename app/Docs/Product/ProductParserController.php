<?php

namespace App\Docs\Product;

class ProductParserController
{



/**
 * @OA\Get(
 *     path="/products-parser/",
 *     summary="Get list of products from the parser",
 *     tags={"Products"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
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
 *                 @OA\Items(
 *                     type="object",
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
 *                         @OA\AdditionalProperties(type="number", example=0)
 *                     ),
 *                 ),
 *             ),
 *         ),
 *     ),
 * )
 */

public function index(){}


}