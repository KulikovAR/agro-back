<?php

namespace App\Docs\Schemas\UserProfile;

/**
 * @OA\Schema(
 *     title="UserProfile",
 *     description="UserProfile model",
 *
 *     @OA\Xml(
 *         name="UserProfile"
 *     )
 * )
 */
class UserProfile
{
    /**
     * @OA\Property(
     *     title="firstname",
     *     description="Имя пользователя",
     *     format="string",
     *     example="Руслан"
     * )
     *
     * @var string
     */
    private $firstname;

    /**
     * @OA\Property(
     *     title="lastname",
     *     description="Фамилия пользователя",
     *     format="string",
     *     example="Смыслов"
     * )
     *
     * @var string
     */
    private $lastname;

    /**
     * @OA\Property(
     *     title="avatar",
     *     description="Путь к аватару пользователя",
     *     format="string",
     *     example="storage/avatar.img"
     * )
     *
     * @var string
     */
    private $avatar;
}
