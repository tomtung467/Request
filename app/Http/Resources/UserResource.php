<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LeaveApplicationResource;

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
            'leave_applications' => $this->when(
                $this->relationLoaded('leaveApplications') && $this->leaveApplications->isNotEmpty(),
                LeaveApplicationResource::collection($this->leaveApplications)
            ),
        ];

    }
}
