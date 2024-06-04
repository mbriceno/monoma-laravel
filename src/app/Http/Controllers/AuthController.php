<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $validated_data = $request->validated();

        if (!$token = auth()->attempt(['username' => $validated_data['username'], 'password' => $validated_data['password']])) {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'errors' => ['Unauthorized'],
                ],
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            'meta' => [
                'success' => true,
                'error' => [],
            ],
            'data' => [
                'message' => 'Successfully logged out',
            ],
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(true, true));
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
            'meta' => [
                'success' => true,
                'error' => [],
            ],
            'data' => [
                'token' => $token,
                'token_type' => 'bearer',
                'minutes_to_expire' => auth()->factory()->getTTL(),
            ],
        ]);
    }
}
