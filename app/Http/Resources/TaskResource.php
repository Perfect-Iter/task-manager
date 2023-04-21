<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->task_id ,
            'name' => $this->task_name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->name,
        ];
    }
}
