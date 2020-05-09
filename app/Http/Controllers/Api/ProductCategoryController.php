<?php

namespace App\Http\Controllers\Api;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\Transformer\ProducCategorytTransformer;

class ProductCategoryController extends ApiController
{
    public function __constructor() {
        parent::__constructor();
    }

    
    /**
     * @OA\Get(
     *     path="/product-categories",
     *     operationId="ApiProductCategoryIndex",
     *     tags={"ProductCategory"},
     *     summary="Get product-categories list",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="List of product-categories"
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
      $product_categories = ProductCategory::all();
      return $this->response->get(['product_categories' => [$product_categories, new ProducCategorytTransformer]]);
 
    }


    /** 
     *@OA\Get(
     *     path="/product-categories/{id}",
     *     operationId="ApiProductCategoryShow",
     *     tags={"ProductCategory"},
     *     summary="Get product-categories by id",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="ProductCategory"
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
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
      return $this->response->get(['product_category' => [$productCategory, new ProducCategorytTransformer]]);
        
    }
}
