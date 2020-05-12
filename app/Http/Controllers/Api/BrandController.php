<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use Illuminate\Http\Request;
use App\Transformer\BrandTransformer;
use App\Http\Controllers\Api\ApiController;
use EllipseSynergie\ApiResponse\Laravel\Response;

class BrandController extends ApiController
{
  /** 
   * @OA\Get(
   *     path="/brands",
   *     operationId="ApiBrandIndex",
   *     tags={"Brand"},
   *     summary="Get brands - products",
   *     @OA\Response(
   *         response="200",
   *         description="Brand"
   *     ),    
   *     @OA\Parameter(
   *         ref="#/components/parameters/include",
   *     )
   * )
   * 
   * Display the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $brands = Brand::first();
      return $this->response->get(['brands' => [$brands, new BrandTransformer]]);
  }
}
