<?php

namespace App\Docs\IC;

class IC
{
    /**
     * @OA\Post(
     *     path="/files/from-1c/{inn}",
     *     tags={"1С"},
     *     summary="Загрузить файл в формате Base64",
     *     description="Загрузка файла с указанием типа и id из 1C. Передаваемые значения в type ограничиваются такими, как Акт, Заявка, Договор",
     *     @OA\Parameter(
     *         name="inn",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="ИНН пользователя"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"type", "file", "id_1c"},
     *             @OA\Property(property="type", type="string", example="Акт"),
     *             @OA\Property(property="file", type="string", format="base64", example="fileInBase64"),
     *             @OA\Property(property="id_1c", type="string", example="someUuid")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешная загрузка",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="string", example="9c957503-fcfb-4951-993b-93e3893137d0"),
     *             @OA\Property(property="path_url", type="string", example="http://localhost/storage/filesBase64/669e67b886cb9.jpg"),
     *             @OA\Property(property="path", type="string", example="/filesBase64/669e67b886cb9.jpg"),
     *             @OA\Property(property="type", type="string", example="Акт"),
     *             @OA\Property(property="id_1c", type="string", example="44bc5645-63f6-42f5-b3b5-f1852a539f4c")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Несуществующий пользователь",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The selected inn is invalid.")
     *         )
     *     )
     * )
     */

    public function loadFileFrom1C()
    {

    }
}
