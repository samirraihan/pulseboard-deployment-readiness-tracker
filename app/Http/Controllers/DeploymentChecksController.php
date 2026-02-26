<?php

namespace App\Http\Controllers;

use App\Models\DeploymentChecks;
use Illuminate\Http\JsonResponse;

class DeploymentChecksController extends Controller
{
    /**
     * Mark a deployment check as completed
     * 
     * @group Deployment Checks
     * @return JsonResponse
     */
    public function complete(DeploymentChecks $check): JsonResponse
    {
        if ($check->is_completed) {
            return response()->json([
                'success' => false,
                'message' => 'This check is already marked as completed.'
            ], 400);
        }

        $check->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $check->fresh()
        ], 200);
    }
}
