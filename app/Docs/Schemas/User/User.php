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

    private $phone_number;
    /**
     * @OA\Property(
     *     title="phone_number",
     *     description="Номер телефона",
     *     format="string",
     *     example="79202149572"
     * )
     *
     * @var string
     */

     private $code;
     /**
      * @OA\Property(
      *     title="code",
      *     description="Пятизначный код в СМС",
      *     format="string",
      *     example="39563"
      * )
      *
      * @var string
      */

      private $code_hash;
     /**
      * @OA\Property(
      *     title="code_hash",
      *     description="Захэшированный код",
      *     format="string",
      *     example="dc10fce584f2cdf09d6690e0f2883227"
      * )
      *
      * @var string
      */

      private $code_expire_at;
      /**
       * @OA\Property(
       *     title="code_expire_at",
       *     description="Время, когда нужно высылать новый код",
       *     format="string",
       *     example="60 секунд"
       * )
       *
       * @var string
       */
}
