<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Users\UserController;
use App\Http\Resources\Users\UserResource;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class LoginController extends UserController
{
    public function __invoke()
    {
        request()->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (EnsureFrontendRequestsAreStateful::fromFrontend(request())) {
            $this->authenticateFrontend();
        } else {
            $user = User::where('username', request()->username)->first();

            return $this->sendResponseWithData('Login successful.', [
                'user' => new UserResource($user),
                'token' => $user->createToken('Access Token')->plainTextToken
            ]);
        }

        return $this->sendResponse('Login successful.');
    }

    private function authenticateFrontend()
    {
        if (!Auth::guard('web')
            ->attempt(
                request()->only('username', 'password')
            )) {
            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }
    }
}
