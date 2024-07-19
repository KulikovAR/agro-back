<?php

namespace App\Docs\Counteragent;

class Counteragent
{
    /**
     * @OA\Post(
     *     path="/counteragents",
     *     summary="Создание контрагента",
     *     description="Создает нового контрагента",
     *     operationId="createCounteragent",
     *     tags={"Counteragents"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="type", type="string", example="ИП"),
     *             @OA\Property(property="inn", type="string", example="123126719011"),
     *             @OA\Property(property="name", type="string", example="Название"),
     *             @OA\Property(property="surname", type="string", example="Фамилия"),
     *             @OA\Property(property="patronymic", type="string", example="Отчество"),
     *             @OA\Property(property="ogrn", type="string", example="123116712012345"),
     *             @OA\Property(property="short_name", type="string", example="Краткое название"),
     *             @OA\Property(property="full_name", type="string", example="Полное название"),
     *             @OA\Property(property="juridical_address", type="string", example="Юридический адрес"),
     *             @OA\Property(property="office_address", type="string", example="Офисный адрес"),
     *             @OA\Property(property="tax_system", type="string", example="ОСНО"),
     *             @OA\Property(property="okved", type="string", example="Код ОКВЭД"),
     *             @OA\Property(property="phone_number", type="string", example="+72121412341"),
     *             @OA\Property(property="department", type="string", example="Department Name"),
     *             @OA\Property(property="series", type="string", example="AB"),
     *             @OA\Property(property="number", type="string", example="123456"),
     *             @OA\Property(property="department_code", type="string", example="123456"),
     *             @OA\Property(property="snils", type="string", example="123-456-789-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Контрагент создан",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Контрагент создан"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="string", example="9c8dc937-c368-4ab2-8678-79cadd8ed119"),
     *                 @OA\Property(property="phone_number", type="string", example="+72121412341"),
     *                 @OA\Property(property="phone_verified_at", type="string", nullable=true, example=null),
     *                 @OA\Property(property="email", type="string", nullable=true, example=null),
     *                 @OA\Property(property="email_verified_at", type="string", nullable=true, example=null),
     *                 @OA\Property(property="password", type="string", nullable=true, example=null),
     *                 @OA\Property(property="moderation_status", type="string", example="approved"),
     *                 @OA\Property(property="created_at", type="string", example="2024-07-18T18:36:41.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2024-07-18T18:36:41.000000Z"),
     *                 @OA\Property(property="inn", type="string", example="123126719011"),
     *                 @OA\Property(property="name", type="string", example="Название"),
     *                 @OA\Property(property="surname", type="string", example="Фамилия"),
     *                 @OA\Property(property="patronymic", type="string", example="Отчество"),
     *                 @OA\Property(property="kpp", type="string", nullable=true, example=null),
     *                 @OA\Property(property="ogrn", type="string", example="123116712012345"),
     *                 @OA\Property(property="type", type="string", example="ИП"),
     *                 @OA\Property(property="short_name", type="string", example="Краткое название"),
     *                 @OA\Property(property="full_name", type="string", example="Полное название"),
     *                 @OA\Property(property="juridical_address", type="string", example="Юридический адрес"),
     *                 @OA\Property(property="office_address", type="string", example="Офисный адрес"),
     *                 @OA\Property(property="tax_system", type="string", example="ОСНО"),
     *                 @OA\Property(property="okved", type="string", example="Код ОКВЭД"),
     *                 @OA\Property(property="series", type="string", nullable=true, example=null),
     *                 @OA\Property(property="number", type="string", nullable=true, example=null),
     *                 @OA\Property(property="department", type="string", nullable=true, example=null),
     *                 @OA\Property(property="department_code", type="string", nullable=true, example=null),
     *                 @OA\Property(property="snils", type="string", nullable=true, example=null),
     *                 @OA\Property(property="issue_date_at", type="string", nullable=true, example=null),
     *                 @OA\Property(
     *                     property="roles",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="string", example="9c8dc716-13eb-445d-ae73-2cdd1740197b"),
     *                         @OA\Property(property="name", type="string", example="Клиент"),
     *                         @OA\Property(property="slug", type="string", example="client")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="files",
     *                     type="array",
     *                     @OA\Items(type="object")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Вы не авторизованы",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="вы не авторизованы")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись не найдена",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="запись не найдена")
     *         )
     *     )
     * )
     */
    public function create()
    {

    }

    /**
     * @OA\Put(
     *     path="/counteragents/{user}",
     *     summary="Обновление контрагента",
     *     description="Обновление контрагента",
     *     operationId="updateCounteragent",
     *     tags={"Counteragents"},
     *     security={{"bearerAuth":{}}},
     *               @OA\Parameter(
     *           name="id",
     *           in="path",
     *           required=true,
     *           description="ID of user",
     *           @OA\Schema(
     *               type="string",
     *               format="uuid"
     *           )
     *       ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="type", type="string", example="ИП"),
     *             @OA\Property(property="inn", type="string", example="123126719011"),
     *             @OA\Property(property="name", type="string", example="Название"),
     *             @OA\Property(property="surname", type="string", example="Фамилия"),
     *             @OA\Property(property="patronymic", type="string", example="Отчество"),
     *             @OA\Property(property="ogrn", type="string", example="123116712012345"),
     *             @OA\Property(property="short_name", type="string", example="Краткое название"),
     *             @OA\Property(property="full_name", type="string", example="Полное название"),
     *             @OA\Property(property="juridical_address", type="string", example="Юридический адрес"),
     *             @OA\Property(property="office_address", type="string", example="Офисный адрес"),
     *             @OA\Property(property="tax_system", type="string", example="ОСНО"),
     *             @OA\Property(property="okved", type="string", example="Код ОКВЭД"),
     *             @OA\Property(property="phone_number", type="string", example="+72121412341"),
     *             @OA\Property(property="department", type="string", example="Department Name"),
     *             @OA\Property(property="series", type="string", example="AB"),
     *             @OA\Property(property="number", type="string", example="123456"),
     *             @OA\Property(property="department_code", type="string", example="123456"),
     *             @OA\Property(property="snils", type="string", example="123-456-789-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Контрагент обновлён",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Контрагент создан"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="string", example="9c8dc937-c368-4ab2-8678-79cadd8ed119"),
     *                 @OA\Property(property="phone_number", type="string", example="+72121412341"),
     *                 @OA\Property(property="phone_verified_at", type="string", nullable=true, example=null),
     *                 @OA\Property(property="email", type="string", nullable=true, example=null),
     *                 @OA\Property(property="email_verified_at", type="string", nullable=true, example=null),
     *                 @OA\Property(property="password", type="string", nullable=true, example=null),
     *                 @OA\Property(property="moderation_status", type="string", example="approved"),
     *                 @OA\Property(property="created_at", type="string", example="2024-07-18T18:36:41.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2024-07-18T18:36:41.000000Z"),
     *                 @OA\Property(property="inn", type="string", example="123126719011"),
     *                 @OA\Property(property="name", type="string", example="Название"),
     *                 @OA\Property(property="surname", type="string", example="Фамилия"),
     *                 @OA\Property(property="patronymic", type="string", example="Отчество"),
     *                 @OA\Property(property="kpp", type="string", nullable=true, example=null),
     *                 @OA\Property(property="ogrn", type="string", example="123116712012345"),
     *                 @OA\Property(property="type", type="string", example="ИП"),
     *                 @OA\Property(property="short_name", type="string", example="Краткое название"),
     *                 @OA\Property(property="full_name", type="string", example="Полное название"),
     *                 @OA\Property(property="juridical_address", type="string", example="Юридический адрес"),
     *                 @OA\Property(property="office_address", type="string", example="Офисный адрес"),
     *                 @OA\Property(property="tax_system", type="string", example="ОСНО"),
     *                 @OA\Property(property="okved", type="string", example="Код ОКВЭД"),
     *                 @OA\Property(property="series", type="string", nullable=true, example=null),
     *                 @OA\Property(property="number", type="string", nullable=true, example=null),
     *                 @OA\Property(property="department", type="string", nullable=true, example=null),
     *                 @OA\Property(property="department_code", type="string", nullable=true, example=null),
     *                 @OA\Property(property="snils", type="string", nullable=true, example=null),
     *                 @OA\Property(property="issue_date_at", type="string", nullable=true, example=null),
     *                 @OA\Property(
     *                     property="roles",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="string", example="9c8dc716-13eb-445d-ae73-2cdd1740197b"),
     *                         @OA\Property(property="name", type="string", example="Клиент"),
     *                         @OA\Property(property="slug", type="string", example="client")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="files",
     *                     type="array",
     *                     @OA\Items(type="object")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Вы не авторизованы",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="вы не авторизованы")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Запись не найдена",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="запись не найдена")
     *         )
     *     )
     * )
     */

    public function update()
    {

    }
}
