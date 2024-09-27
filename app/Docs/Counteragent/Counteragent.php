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
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="type", type="string", example="ИП"),
     * *             @OA\Property(property="inn", type="string", example="123456789021"),
     * *             @OA\Property(property="name", type="string", example="Иван"),
     * *             @OA\Property(property="surname", type="string", example="Иванов"),
     * *             @OA\Property(property="patronymic", type="string", example="Иванович"),
     * *             @OA\Property(property="kpp", type="string", example="123456781"),
     * *             @OA\Property(property="ogrn", type="string", example="123456789012322"),
     * *             @OA\Property(property="short_name", type="string", example="ООО Рога и Копыта"),
     * *             @OA\Property(property="full_name", type="string", example="Общество с ограниченной ответственностью Рога и Копыта"),
     * *             @OA\Property(property="juridical_address", type="string", example="ул. Примерная, д. 1, г. Москва"),
     * *             @OA\Property(property="office_address", type="string", example="ул. Примерная, д. 1, офис 101, г. Москва"),
     * *             @OA\Property(property="tax_system", type="string", example="ОСНО"),
     * *             @OA\Property(property="okved", type="string", example="62.01"),
     * *             @OA\Property(property="number", type="string", example="12345678"),
     * *             @OA\Property(property="series", type="string", example="1234"),
     * *             @OA\Property(property="department", type="string", example="Примерный отдел"),
     * *             @OA\Property(property="department_code", type="string", example="1234"),
     * *             @OA\Property(property="snils", type="string", example="12345678900"),
     * *             @OA\Property(property="phone_number", type="string", example="+71232567890"),
     * *             @OA\Property(property="email", type="string", example="example@exampl2.com"),
     * *             @OA\Property(property="region", type="string", example="Москва"),
     * *             @OA\Property(property="accountant_phone", type="string", example="+71224567891"),
     * *             @OA\Property(property="director_name", type="string", example="Иван"),
     * *             @OA\Property(property="director_surname", type="string", example="Петров"),
     * *             @OA\Property(property="gender", type="string", example="M"),
     * *             @OA\Property(property="bdate", type="string", example="1990-01-01"),
     * *             @OA\Property(property="issue_date_at", type="string", example="2023-01-01")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Контрагент создан",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Контрагент создан"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="string", example="9ca00a89-98ad-4f78-9cb9-16923a32a491"),
     * *                 @OA\Property(property="phone_number", type="string", example="+71232567890"),
     * *                 @OA\Property(property="email", type="string", example="example@exampl2.com"),
     * *                 @OA\Property(property="moderation_status", type="string", example="approved"),
     * *                 @OA\Property(property="inn", type="string", example="123456789021"),
     * *                 @OA\Property(property="name", type="string", example="Иван"),
     * *                 @OA\Property(property="surname", type="string", example="Иванов"),
     * *                 @OA\Property(property="patronymic", type="string", example="Иванович"),
     * *                 @OA\Property(property="kpp", type="string", example="123456781"),
     * *                 @OA\Property(property="ogrn", type="string", example="123456789012322"),
     * *                 @OA\Property(property="type", type="string", example="ИП"),
     * *                 @OA\Property(property="short_name", type="string", example="ООО Рога и Копыта"),
     * *                 @OA\Property(property="full_name", type="string", example="Общество с ограниченной ответственностью Рога и Копыта"),
     * *                 @OA\Property(property="juridical_address", type="string", example="ул. Примерная, д. 1, г. Москва"),
     * *                 @OA\Property(property="office_address", type="string", example="ул. Примерная, д. 1, офис 101, г. Москва"),
     * *                 @OA\Property(property="tax_system", type="string", example="ОСНО"),
     * *                 @OA\Property(property="okved", type="string", example="62.01"),
     * *                 @OA\Property(property="series", type="string", example="1234"),
     * *                 @OA\Property(property="number", type="string", example="12345678"),
     * *                 @OA\Property(property="department", type="string", example="Примерный отдел"),
     * *                 @OA\Property(property="department_code", type="string", example="1234"),
     * *                 @OA\Property(property="snils", type="string", example="12345678900"),
     * *                 @OA\Property(property="issue_date_at", type="string", example="01.01.2023"),
     * *                 @OA\Property(property="creator_id", type="string", example="9c9fe49d-dd0c-41eb-aebb-e4179c8e4407"),
     * *                 @OA\Property(property="region", type="string", example="Москва"),
     * *                 @OA\Property(property="accountant_phone", type="string", example="+71224567891"),
     * *                 @OA\Property(property="director_name", type="string", example="Иван"),
     * *                 @OA\Property(property="director_surname", type="string", example="Петров"),
     * *                 @OA\Property(property="bdate", type="string", example=null),
     * *                 @OA\Property(property="gender", type="string", example="M"),
     *                 @OA\Property(
     *                     property="roles",
     *                     type="array",
     *
     *                     @OA\Items(
     *                         type="object",
     *
     *                         @OA\Property(property="id", type="string", example="9c8dc716-13eb-445d-ae73-2cdd1740197b"),
     *                         @OA\Property(property="name", type="string", example="Клиент"),
     *                         @OA\Property(property="slug", type="string", example="client")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="files",
     *                     type="array",
     *
     *                     @OA\Items(type="object")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Вы не авторизованы",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="вы не авторизованы")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Запись не найдена",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
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
     *
     *               @OA\Parameter(
     *           name="id",
     *           in="path",
     *           required=true,
     *           description="ID of user",
     *
     *           @OA\Schema(
     *               type="string",
     *               format="uuid"
     *           )
     *       ),
     *
     *     @OA\RequestBody(
     *         required=false,
     *
     *         @OA\JsonContent(
     *             type="object",
    @OA\Property(property="type", type="string", example="ИП"),
     *              @OA\Property(property="inn", type="string", example="123456789021"),
     *              @OA\Property(property="name", type="string", example="Иван"),
     *              @OA\Property(property="surname", type="string", example="Иванов"),
     *              @OA\Property(property="patronymic", type="string", example="Иванович"),
     *              @OA\Property(property="kpp", type="string", example="123456781"),
     *              @OA\Property(property="ogrn", type="string", example="123456789012322"),
     *              @OA\Property(property="short_name", type="string", example="ООО Рога и Копыта"),
     *              @OA\Property(property="full_name", type="string", example="Общество с ограниченной ответственностью Рога и Копыта"),
     *              @OA\Property(property="juridical_address", type="string", example="ул. Примерная, д. 1, г. Москва"),
     *              @OA\Property(property="office_address", type="string", example="ул. Примерная, д. 1, офис 101, г. Москва"),
     *              @OA\Property(property="tax_system", type="string", example="ОСНО"),
     *              @OA\Property(property="okved", type="string", example="62.01"),
     *              @OA\Property(property="number", type="string", example="12345678"),
     *              @OA\Property(property="series", type="string", example="1234"),
     *              @OA\Property(property="department", type="string", example="Примерный отдел"),
     *              @OA\Property(property="department_code", type="string", example="1234"),
     *              @OA\Property(property="snils", type="string", example="12345678900"),
     *              @OA\Property(property="phone_number", type="string", example="+71232567890"),
     *              @OA\Property(property="email", type="string", example="example@exampl2.com"),
     *              @OA\Property(property="region", type="string", example="Москва"),
     *              @OA\Property(property="accountant_phone", type="string", example="+71224567891"),
     *              @OA\Property(property="director_name", type="string", example="Иван"),
     *              @OA\Property(property="director_surname", type="string", example="Петров"),
     *              @OA\Property(property="gender", type="string", example="M"),
     *              @OA\Property(property="bdate", type="string", example="1990-01-01"),
     *              @OA\Property(property="issue_date_at", type="string", example="2023-01-01")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Контрагент обновлён",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="message", type="string", example="Контрагент создан"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="string", example="9ca00a89-98ad-4f78-9cb9-16923a32a491"),
     * *                 @OA\Property(property="phone_number", type="string", example="+71232567890"),
     * *                 @OA\Property(property="email", type="string", example="example@exampl2.com"),
     * *                 @OA\Property(property="moderation_status", type="string", example="approved"),
     * *                 @OA\Property(property="inn", type="string", example="123456789021"),
     * *                 @OA\Property(property="name", type="string", example="Иван"),
     * *                 @OA\Property(property="surname", type="string", example="Иванов"),
     * *                 @OA\Property(property="patronymic", type="string", example="Иванович"),
     * *                 @OA\Property(property="kpp", type="string", example="123456781"),
     * *                 @OA\Property(property="ogrn", type="string", example="123456789012322"),
     * *                 @OA\Property(property="type", type="string", example="ИП"),
     * *                 @OA\Property(property="short_name", type="string", example="ООО Рога и Копыта"),
     * *                 @OA\Property(property="full_name", type="string", example="Общество с ограниченной ответственностью Рога и Копыта"),
     * *                 @OA\Property(property="juridical_address", type="string", example="ул. Примерная, д. 1, г. Москва"),
     * *                 @OA\Property(property="office_address", type="string", example="ул. Примерная, д. 1, офис 101, г. Москва"),
     * *                 @OA\Property(property="tax_system", type="string", example="ОСНО"),
     * *                 @OA\Property(property="okved", type="string", example="62.01"),
     * *                 @OA\Property(property="series", type="string", example="1234"),
     * *                 @OA\Property(property="number", type="string", example="12345678"),
     * *                 @OA\Property(property="department", type="string", example="Примерный отдел"),
     * *                 @OA\Property(property="department_code", type="string", example="1234"),
     * *                 @OA\Property(property="snils", type="string", example="12345678900"),
     * *                 @OA\Property(property="issue_date_at", type="string", example="01.01.2023"),
     * *                 @OA\Property(property="creator_id", type="string", example="9c9fe49d-dd0c-41eb-aebb-e4179c8e4407"),
     * *                 @OA\Property(property="region", type="string", example="Москва"),
     * *                 @OA\Property(property="accountant_phone", type="string", example="+71224567891"),
     * *                 @OA\Property(property="director_name", type="string", example="Иван"),
     * *                 @OA\Property(property="director_surname", type="string", example="Петров"),
     * *                 @OA\Property(property="bdate", type="string", example=null),
     * *                 @OA\Property(property="gender", type="string", example="M"),
     *                 @OA\Property(
     *                     property="roles",
     *                     type="array",
     *
     *                     @OA\Items(
     *                         type="object",
     *
     *                         @OA\Property(property="id", type="string", example="9c8dc716-13eb-445d-ae73-2cdd1740197b"),
     *                         @OA\Property(property="name", type="string", example="Клиент"),
     *                         @OA\Property(property="slug", type="string", example="client")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="files",
     *                     type="array",
     *
     *                     @OA\Items(type="object")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Вы не авторизованы",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="вы не авторизованы")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Запись не найдена",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="запись не найдена")
     *         )
     *     )
     * )
     */
    public function update()
    {

    }
}
