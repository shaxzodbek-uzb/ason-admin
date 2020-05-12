<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use Illuminate\Http\Request;
use App\Transformer\BrandTransformer;
use App\Http\Controllers\Controller;
use EllipseSynergie\ApiResponse\Contracts\Response;

class BrandController extends Controller
{
    protected $response;  
    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

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
      return $this->response->withItem($brands, new BrandTransformer);
  }
}
