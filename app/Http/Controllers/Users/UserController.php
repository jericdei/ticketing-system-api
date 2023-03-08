<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\Common\ModelService;
use App\Services\Common\QueryService;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function __construct(
        private QueryService $queryService,
        private ModelService $modelService
    ) {}

    /**
     * Get a list of users.
     */
    public function index(): JsonResource
    {
        return UserResource::collection($this->queryService->getMultiple(new User, request()));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = $this->modelService->storeModel(new User, $request->validated());

        return $this->sendResponseWithData('User created successfully.', $user);
    }

    /**
     * Get a specified user.
     */
    public function show(User $user): JsonResource
    {
        return new UserResource($this->queryService->getSingle($user, request()));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(User $user, UpdateRequest $request)
    {
        $user = $this->modelService->updateModel($user, $request->validated());

        return $this->sendResponseWithData('User updated successfully.', $user);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->sendResponse('User deleted successfully.');
    }
}
