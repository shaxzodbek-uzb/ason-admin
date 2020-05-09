<?php

/**
 * @OA\Schema(
 *     description="Request object for update cart.",
 *     type="object",
 *     title="Cart update request",
 * )
 */
class ApiCartUpdateRequest
{
    /**
     * @OA\Property(
     *     title="Meta",
     *     description="Cart meta data",
     *     format="json",
     *     example="{products: []}"
     * )
     *
     * @var string
     */
    public $meta;
}