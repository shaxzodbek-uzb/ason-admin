<?php

namespace App\Http\Controllers\Api;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\Transformer\ProducCategorytTransformer;
use EllipseSynergie\ApiResponse\Laravel\Response;

class ProductCategoryController extends ApiController
{
    public function __constructor(Response $response) {
        parent::__constructor($response);
    }

    
    /**
     * @OA\Get(
     *     path="/categories",
     *     operationId="ApiCategoryIndex",
     *     tags={"Category"},
     *     summary="Get categories list",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="List of categories"
     *     ),
     *     @OA\Parameter(
     *           ref="#/components/parameters/limit",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/page",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/include",
     *     )
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $product_categories = Category::all();
      return $this->response->get(['product_categories' => [$product_categories, new ProducCategorytTransformer]]);
 
    }


    /** 
     *@OA\Get(
     *     path="/categories/{id}",
     *     operationId="ApiCategoryShow",
     *     tags={"Category"},
     *     summary="Get categories by id",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Category"
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/id",
     *     ),     
     *     @OA\Parameter(
     *          ref="#/components/parameters/include",
     *     )
     * )
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
      return $this->response->get(['category' => [$category, new CategoryTransformer]]);
        
    }
}
