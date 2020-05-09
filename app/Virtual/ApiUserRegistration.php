<?php

/**
 * @OA\Schema(
 *     description="Request object for log on user.",
 *     type="object",
 *     title="User logon request",
 * )
 */
class ApiUserRegistrationRequest
{
    /**
     * @OA\Property(
     *     title="Name",
     *     description="User name",
     *     format="string",
     *     example="Admin"
     * )
     *
     * @var string
     */
    public $name;
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

    /**
     * @OA\Property(
     *     title="Password confirmation",
     *     description="password_confirmation",
     *     format="string",
     *     example="admin"
     * )
     *
     * @var string
     */
    public $password_confirmation;
}