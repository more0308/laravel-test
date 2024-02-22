<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
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
            'full_name' => $this->full_name,
            'test_location' => $this->test_location,
            'test_date' => $this->test_date,
            'grade' => $this->grade,
            'criterion' => $this->criterion,
            'manager_name' => $this->manager->name,
            'manager_id' => $this->manager_id,
        ];
    }
}
