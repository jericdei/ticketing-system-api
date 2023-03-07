<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends UserController
{
    /**
     * Get the authenticated user's data.
     *
     */
    public function me(Request $request): JsonResource
    {
        return $this->show(Auth::user(), $request);
    }


    /**
     * Start an authenticated session.
     *
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (!Auth::attempt($request->only(['username', 'password']))) {
                return $this->sendResponse('Credentials does not match.', 401);
            }

            $user = User::where('username', $request->username)->first();

            return $this->sendResponseWithData('User logged in successfully.', [
                'user' => new UserResource($user),
                'token' => $user->createToken('Access Token')->plainTextToken
            ]);
        } catch (\Throwable $th) {
            return $this->sendResponse($th->getMessage(), 500);
        }
    }

    /**
     * Ends an authenticated session.
     *
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse('User logged out successfully.');
    }
}
