<?php

namespace App\Docs\Schemas\User;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */

class User
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
     *     title="email",
     *     description="Почта пользователя",
     *     format="string",
     *     example="nfs2025@mail.ru"
     * )
     *
     * @var string
     */
    private $email;
    /**
     * @OA\Property(
     *     title="email_verified_at",
     *     description="Подтверждение почты",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var string
     */
    private $email_verified_at;
    /**
     *@OA\Property(
     *      property="userprofile",
     *      ref="#/components/schemas/UserProfile"
     *)
     *
     * @var string
     */
    private $profile;
}
