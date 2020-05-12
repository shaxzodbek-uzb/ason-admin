<?php

namespace App\Http\Controllers\Api;

use App\Vacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use EllipseSynergie\ApiResponse\Laravel\Response;

class VacancyController extends ApiController
{
  public function __constructor(Response $response) {
    parent::__constructor($response);

  }
  /** 
   * @OA\Get(
   *     path="/vacancies",
   *     operationId="ApiVacancyIndex",
   *     tags={"Vacancy"},
   *     summary="Get vacancies",
   *     @OA\Response(
   *         response="200",
   *         description="Vacancy"
   *     ),    
   *     @OA\Parameter(
   *          ref="#/components/parameters/include",
   *     )
   * )
   * 
   * Display the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $vacancies = Vacancy::all();
      return $this->response->get(['vacancies' => [$vacancies, new VacancyTransformer]]);
  }
}
