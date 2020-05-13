<?php
/**
 * @OA\Info(
 *     title="Ason API documentation",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="shaxzodbek.qambaraliyev@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Product",
 *     description="Product api collection",
 * )
 * @OA\Tag(
 *     name="Cart",
 *     description="Cart api collection",
 * )
 * @OA\Tag(
 *     name="Country",
 *     description="Country api collection",
 * )
 * @OA\Tag(
 *     name="Order",
 *     description="Order api collection",
 * )
 * @OA\Tag(
 *     name="Category",
 *     description="Category api collection",
 * )
 * @OA\Tag(
 *     name="User",
 *     description="User api collection",
 * )
 * @OA\Tag(
 *     name="User",
 *     description="Brand api collection",
 * )
 *  @OA\Tag(
 *     name="Page",
 *     description="Page api collection",
 * )
 * @OA\Tag(
 *     name="Vacancy",
 *     description="Vacancy api collection",
 * )
 * @OA\Server(
 *     description="Ason backend server",
 *     url="/api"
 * ) 
 * @OA\SecurityScheme(
 *      securityScheme="token",
 *      in="header",
 *      name="Authorization",
 *      type="apiKey",
 *      scheme="Bearer"
 * )
 * 
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use EllipseSynergie\ApiResponse\Laravel\Response;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
  protected $response;
  public function __construct(Response $response) {
    $this->response = $response;
    if (isset($_GET['include'])) {
        $response->getManager()->parseIncludes($_GET['include']);
    }
  }

}
