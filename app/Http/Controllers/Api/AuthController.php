<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Transformer\UserTransformer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController;
use EllipseSynergie\ApiResponse\Laravel\Response;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(Response $response)
    {
        parent::__construct($response);
        $this->middleware('auth:api', ['except' => ['login','registration']]);
    }

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     operationId="ApiAuthLogin",
     *     tags={"User"},
     *     summary="Login with user credentials",
     *     @OA\Response(
     *         response="200",
     *         description="Successfuly loged you in!"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ApiUserLoginRequest")
     *     )
     * )
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    /**
     * @OA\Post(
     *     path="/auth/registration",
     *     operationId="ApiAuthRegistration",
     *     tags={"User"},
     *     summary="Registration of user",
     *     @OA\Response(
     *         response="200",
     *         description="Successfuly loged you on!"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ApiUserRegistrationRequest")
     *     )
     * )
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        $credentials = request(['name','email', 'password']);
        $user = User::create($credentials);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    /**
     * @OA\Post(
     *     path="/auth/me",
     *     operationId="ApiAuthMe",
     *     tags={"User"},
     *     summary="Get user-info by token.",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="You have access to use system."
     *     )
     * )
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
      return $this->response->get([
          'user' => [auth()->user(), new UserTransformer]
      ]);
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     operationId="ApiAuthLogout",
     *     tags={"User"},
     *     summary="Logout user.",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Successfully logged out."
     *     )
     * )
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
      auth()->logout();

      return response()->json([
          'code' => 200,
          'data' => [
              'message' => 'Successfully logged out'
          ]
      ]);
    }

    /**
     * @OA\Post(
     *     path="/auth/refresh",
     *     operationId="ApiAuthRefresh",
     *     tags={"User"},
     *     summary="Refresh user token.",
     *     security={
     *       {"token": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Token successfully refreshed."
     *     )
     * )
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
      return response()->json([
          'code' => 200,
          'data' => [
              'access_token' => $token,
              'token_type' => 'bearer',
              'expires_in' => auth()->factory()->getTTL() * 60
          ]
      ]);
    }
}