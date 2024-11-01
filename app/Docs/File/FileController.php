<?php

namespace App\Docs\File;

class FileController
{
    /**
     * @OA\Post(
     *      path="/files/load-files",
     *      operationId="loadFiles",
     *      tags={"Files"},
     *      security={{"bearerAuth":{}}},
     *      summary="Загрузить документы пользователя",
     *      description="Загружает документы пользователя.",
     *
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *
     *              @OA\Schema(
     *                  required={"file_types", "load_files"},
     *
     *                  @OA\Property(type="string", example="9bdec27c-a40d-463e-a709-0ff9ab7efd11"),
     *                  @OA\Property(
     *                      property="documents(file)",
     *                      type="array",
     *
     *                      @OA\Items(type="file")
     *                  ),
     *
     *                       @OA\Property(
     *                       property="documents(file_type)",
     *                       type="array",
     *
     *                       @OA\Items(type="string")
     *                   )
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example="Документы пользователя загружены"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *
     *                  @OA\Items(
     *
     *                      @OA\Property(property="id", type="string", example="9bdf09f2-f0a7-458f-acc6-5a94a5c88fbc"),
     *                      @OA\Property(property="path_url", type="string", example="http://localhost/storage/files/4R0V5abSTtHNxfJudzlAWuB8NdIWvnmOMafrJip4.jpg"),
     *                      @OA\Property(property="original_name", type="string", example="file.jpeg"),
    @OA\Property(property="mime_type", type="string", example="application/vnd.openxmlformats-officedocument.wordprocessingml.document"),     *     @OA\Property(property="extension", type="string", example="jpeg"),
     *                          @OA\Property(
     *                          property="fileType",
     *                          type="object",
     *                          @OA\Property(property="id", type="string", example="9bdec27c-8c53-4155-8646-c60bdbbe3ff3"),
     *                          @OA\Property(property="title", type="string", example="ЭТРН")
     *                      ),
     *                      @OA\Property(
     *                          property="userFiles",
     *                          type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(property="id", type="integer", example=27),
     *                              @OA\Property(property="user_id", type="string", example="9bdec27c-a40d-463e-a709-0ff9ab7efd11")
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function loadFilesForUser() {}

    /**
     * @OA\Post (
     *      path="/files/update-files",
     *      operationId="updateFiles",
     *      tags={"Files"},
     *      security={{"bearerAuth":{}}},
     *      summary="Обновить документы пользователя",
     *      description="Обновить документы пользователя.",
     *
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *
     *              @OA\Schema(
     *                  required={"file_types", "load_files"},
     *
     *                  @OA\Property(type="string", example="9bdec27c-a40d-463e-a709-0ff9ab7efd11"),
     *                  @OA\Property(
     *                      property="documents(file)",
     *                      type="array",
     *
     *                      @OA\Items(type="file")
     *                  ),
     *
     *                       @OA\Property(
     *                       property="documents(file_type)",
     *                       type="array",
     *
     *                       @OA\Items(type="string")
     *                   ),
     *
     *                        @OA\Property(
     *                        property="documents(file_id)",
     *                        type="array",
     *
     *                        @OA\Items(type="string")
     *                    ),
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example="Документы пользователя загружены"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *
     *                  @OA\Items(
     *
     *                      @OA\Property(property="id", type="string", example="9bdf09f2-f0a7-458f-acc6-5a94a5c88fbc"),
     *                      @OA\Property(property="path_url", type="string", example="http://localhost/storage/files/4R0V5abSTtHNxfJudzlAWuB8NdIWvnmOMafrJip4.jpg"),
     *                      @OA\Property(property="original_name", type="string", example="file.jpeg"),
    @OA\Property(property="mime_type", type="string", example="application/vnd.openxmlformats-officedocument.wordprocessingml.document"),     *     @OA\Property(property="extension", type="string", example="jpeg"),
     *                          @OA\Property(
     *                          property="fileType",
     *                          type="object",
     *                          @OA\Property(property="id", type="string", example="9bdec27c-8c53-4155-8646-c60bdbbe3ff3"),
     *                          @OA\Property(property="title", type="string", example="ЭТРН")
     *                      ),
     *                      @OA\Property(
     *                          property="userFiles",
     *                          type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(property="id", type="integer", example=27),
     *                              @OA\Property(property="user_id", type="string", example="9bdec27c-a40d-463e-a709-0ff9ab7efd11")
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function updateFilesForUser() {}

    /**
     * @OA\Get(
     *     path="files/on-signing",
     *     summary="Получить список подписанных документов",
     *     tags={"Files"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="OK"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example=""
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *
     *                 @OA\Items(
     *                     type="object",
     *
     *                     @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example="9c93b119-2f88-47e7-9446-cbcb959bf529"
     *                     ),
     *                     @OA\Property(
     *                         property="path_url",
     *                         type="string",
     *                         example="http://localhost/storage/files/Z0UI0ef03HX2pUCXgQwIFPrfmxTIY6YCExFJbDLj.jpg"
     *                     ),
     *                     @OA\Property(
     *                         property="path",
     *                         type="string",
     *                         example="files/Z0UI0ef03HX2pUCXgQwIFPrfmxTIY6YCExFJbDLj.jpg"
     *                     ),
     *                     @OA\Property(
     *                         property="type",
     *                         type="string",
     *                         example="Акт"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="error"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthorized"
     *             )
     *         )
     *     )
     * )
     */
    public function getDocumentsForSigning(Request $request)
    {
        // Ваш код для обработки запроса
    }

    /**
     * @OA\Get(
     *     path="files/file-types",
     *     summary="Получить все типы документов",
     *     tags={"Files"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="OK"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Получены все типы документов"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *
     *                 @OA\Items(
     *                     type="string",
     *                     example="Акт"
     *                 ),
     *                 example={
     *                     "Акт",
     *                     "Заявка",
     *                     "Договор",
     *                     "Аватар",
     *                     "ПСФЛ",
     *                     "ЕФС",
     *                     "Реквизиты",
     *                     "Патент",
     *                     "УСН",
     *                     "НДС"
     *                 }
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="error"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthorized"
     *             )
     *         )
     *     )
     * )
     */
    public function getFileTypes() {}
}
