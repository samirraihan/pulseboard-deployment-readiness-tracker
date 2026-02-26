<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeploymentCheckResource extends JsonResource
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
            'title' => $this->title,
            'is_completed' => $this->is_completed,
            'created_at' => $this->created_at ? $this->created_at->format('F j, Y, g:i a') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('F j, Y, g:i a') : null,
        ];
    }
}
