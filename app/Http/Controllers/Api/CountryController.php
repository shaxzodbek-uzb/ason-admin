<?php

namespace App\Http\Controllers\Api;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformer\CountryTransformer;
use App\Http\Controllers\Api\ApiController;
use EllipseSynergie\ApiResponse\Laravel\Response;

class CountryController extends ApiController
{

    public function __constructor() {
        parent::__constructor();
    }


    /**
     * @OA\Get(
     *     path="/countries",
     *     operationId="ApiCountryIndex",
     *     tags={"Country"},
     *     summary="Get countries list",
     *     @OA\Response(
     *         response="200",
     *         description="List of countries"
     *     )
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return $this->response->get(['countries' => [$countries, new CountryTransformer]]);
    }
}
