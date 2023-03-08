<?php

namespace App\Http\Resources\Tickets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'ticket_code' => $this->ticket_code,
            'subject' => $this->subject,
            'description' => $this->description,
            'is_follow_up' => $this->is_follow_up,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'with_email' => $this->with_email,
            'user' => new \App\Http\Resources\Users\UserResource($this->whenLoaded('user')),
            'department' => new \App\Http\Resources\Common\DepartmentResource($this->whenLoaded('department')),
            'type' => new \App\Http\Resources\Tickets\TypeResource($this->whenLoaded('type')),
            'status' => new \App\Http\Resources\Tickets\StatusResource($this->whenLoaded('status')),
            'priority' => new \App\Http\Resources\Tickets\PriorityResource($this->whenLoaded('priority')),
            'concern' => new \App\Http\Resources\Tickets\ConcernResource($this->whenLoaded('concern')),
            'replies' => \App\Http\Resources\Tickets\Replies\ReplyResource::collection($this->whenLoaded('replies')),
            'files' => \App\Http\Resources\Tickets\FileResource::collection($this->whenLoaded('files')),
            'status_updated_at' => $this->status_updated_at,
            'resolved_at' => $this->resolved_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
    }
}
