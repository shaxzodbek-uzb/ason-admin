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
    /**
     * @OA\Parameter(
     *     in="query",
     *     name="parent_id",
     *     description="Parent id",
     * )
     *
     * @var integer
     */
    public $parent_id;
}