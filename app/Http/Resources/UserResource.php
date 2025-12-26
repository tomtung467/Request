<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LeaveRequestResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'leave_requests' => $this->when(
                $this->relationLoaded('leaveRequests') && $this->leaveRequests->isNotEmpty(),
                LeaveRequestResource::collection($this->leaveRequests)
            ),
        ];

    }
}
