<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use EllipseSynergie\ApiResponse\Laravel\Response;

class CartController extends ApiController
{
    public function __constructor(Response $response) {
      parent::__constructor($response);
      $this->middleware('auth:api');

    }
    /** 
     * @OA\Get(
     *     path="/carts",
     *     operationId="ApiCartShow",
     *     tags={"Cart"},
     *     summary="Get Cart by auth",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Cart"
     *     ),    
     *     @OA\Parameter(
     *          ref="#/components/parameters/include",
     *     )
     * )
     * 
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = auth()->user->cart;
        if (Is_null($cart)){
			$cart = auth()->user->cart()->create();
        }
        return $this->response->get(['cart' => [$cart, new CartTransformer]]);
    }

    /** 
     * @OA\Put(
     *     path="/carts",
     *     operationId="ApiCartUpdate",
     *     tags={"Cart"},
     *     summary="Update Cart by auth",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ApiCartUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Cart"
     *     )
     * )
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$cart->update(['meta' => $request->meta]);

		return $this->response->get(['cart' => [$cart, new CartTransformer]]);
    }

     /** 
     * @OA\Delete(
     *     path="/carts",
     *     operationId="ApiCartDelete",
     *     tags={"Cart"},
     *     summary="Delete Cart by auth",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Cart"
     *     )
     * )
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $cart = auth()->user->cart;
        if ($cart){
            $cart->update(['meta' => null]);

            return $this->response->get(['cart' => [$cart, new CartTransformer]]);
        }
    }
}
