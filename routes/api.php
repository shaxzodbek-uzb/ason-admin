<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'
], function ($router) {
  Route::post('registration', 'Api\AuthController@registration');
  Route::post('login', 'Api\AuthController@login');
  Route::post('logout', 'Api\AuthController@logout');
  Route::post('refresh', 'Api\AuthController@refresh');
  Route::post('me', 'Api\AuthController@me');
});
Route::resource('products', 'Api\ProductController');
Route::resource('orders', 'Api\OrderController');
Route::resource('cart', 'Api\CartController');
Route::resource('countries', 'Api\CountryController');
Route::resource('product-categories', 'Api\ProductCategoryController');