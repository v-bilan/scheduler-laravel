<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskWitnessDateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'taskwitnessdate',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'date' => $this->date,
                'task' => $this->task,
            ],
            'includes' => [
                (object) ['type' => 'role', 'id' => $this->role_id],
                (object) ['type' => 'witness', 'id' => $this->witness_id]
            ],
            'links' => [
                'self' => route('api.task-witness-date.show', ['task_witness_date' => $this->id])
            ]
        ];
    }
}
