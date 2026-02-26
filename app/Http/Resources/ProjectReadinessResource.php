<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectReadinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalChecks = $this->deploymentChecks()->count();
        $completedChecks = $this->deploymentChecks()->where('is_completed', true)->count();
        
        return [
            'project' => $this->name,
            'total_checks' => $totalChecks,
            'completed_checks' => $completedChecks,
            'is_ready_for_deployment' => $totalChecks > 0 && $totalChecks === $completedChecks
        ];
    }
}
