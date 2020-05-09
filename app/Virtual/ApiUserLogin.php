<?php

/**
 * @OA\Schema(
 *     description="Request object for login user.",
 *     type="object",
 *     title="User login request",
 * )
 */
class ApiUserLoginRequest
{
    /**
     * @OA\Property(
     *     title="Email",
     *     description="User email address",
     *     format="email",
     *     example="admin@ason.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="password",
     *     format="string",
     *     example="admin"
     * )
     *
     * @var string
     */
    public $password;
}