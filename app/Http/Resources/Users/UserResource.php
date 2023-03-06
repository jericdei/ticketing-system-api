<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Common\DepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_filter([
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'company_address' => $this->company_address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'position' => new PositionResource($this->whenLoaded('position')),
            'department' => new DepartmentResource($this->whenLoaded('department')),
        ]);
    }
}
