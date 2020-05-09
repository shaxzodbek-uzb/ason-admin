<?php

class ApiIndex
{

    /**
     * @OA\Parameter(
     *     in="query",
     *     name="limit",
     *     description="Limit of items(numeric)"
     * )
     *
     * @var string
     */
    public $limit;

    /**
     * @OA\Parameter(
     *     in="query",
     *     name="page",
     *     description="Number of page(numeric)",
     * )
     *
     * @var string
     */
    public $page;
    /**
     * @OA\Parameter(
     *     in="query",
     *     name="include",
     *     description="Name of includes(string: media,author)",
     * )
     *
     * @var string
     */
    public $include;
}