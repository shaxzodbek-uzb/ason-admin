<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
      /**
     * @OA\Get(
     *     path="/pages/home",
     *     operationId="ApiPagesHome",
     *     tags={"Page"},
     *     summary="Get home page",
     *     @OA\Response(
     *         response="200",
     *         description="home page data"
     *     )
     * )
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
      $categories_1 = Category::withDepth()->having('depth', '=', 1)->get();
      $banner_1 = Banner::find(1);
      $category_1 = Category::where('id', 9)->with('products')->first();
      return response()->json([
        'categories_1' => $categories_1,
        'banner_1' => $banner_1,
        'category_1' => $category_1
      ]);
    }
}
