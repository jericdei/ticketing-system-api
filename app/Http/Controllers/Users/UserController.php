<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;
use App\Services\Common\QueryService;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function __construct(private QueryService $queryService) {}

    /**
     * Display a list of users.
     */
    public function index(Request $request): JsonResource
    {
        return UserResource::collection($this->queryService->getMultiple(new User, $request));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): JsonResource
    {
        return new UserResource($this->queryService->getSingle($user));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
