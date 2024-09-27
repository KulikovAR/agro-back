<?php

namespace App\Docs;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Documentation",
 *      description="Documentation API",
 *
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Tag(
 *      name="Registration",
 *      description="Регистрация"
 * )
 * @OA\Tag(
 *      name="Login",
 *      description="Авторизация"
 * )
 *  OA\Tag(
 *      name="Product",
 *      description="Продукты для парсера"
 * )
 * @OA\Tag(
 *      name="UserProfile",
 *      description="Настройки пользователя"
 * )
 *
 * @OA\Server(
 *      url="/api/v1",
 *      description="API Server"
 * )
 * @OA\Server(
 *      url="/",
 *      description="Session Server"
 * )
 *
 * @OA\SecurityScheme(
 *  *     type="http",
 *  *     scheme="bearer",
 *  *     securityScheme="bearerAuth"
 *  * )
 */
class ApiDocs
{
}
