<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WitnessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'witness',
            'id' => $this->id,
            'attributes' => [
                'fullName' => $this->full_name,
                'active' => $this->active,
                'id' => $this->id
            ],
            'includes' => RoleResource::collection($this->whenLoaded('roles')),
            'links' => [
                'self' => route('api.witness.show', ['witness' => $this->id])
            ]
        ];
    }
}
