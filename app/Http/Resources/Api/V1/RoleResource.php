<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

        return [
            'type' => 'role',
            'id' => $this->id,
            $this->mergeWhen(
                $request->routeIs('api.role.*'),
                [
                    'attributes' => [
                        'name' => $this->name,
                        'priority' => $this->priority,
                        'id' => $this->id
                    ],
                    'links' => [
                        'self' => route('api.role.show', ['role' => $this->id])
                    ]
                ]
            ),
        ];
    }
}
