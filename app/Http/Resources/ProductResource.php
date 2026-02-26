<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'owner_email' => $this->owner_email,
            'release_date' => $this->release_date ? $this->release_date->format('F j, Y') : null,
            'total_checks' => $this->deploymentChecks()->count(),
            'completed_checks' => $this->deploymentChecks()->where('is_completed', true)->count()
        ];
    }
}
