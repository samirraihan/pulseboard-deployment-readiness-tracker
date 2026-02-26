<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProjectReadinessResource;
use App\Http\Resources\DeploymentCheckResource;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * List all projects
     * 
     * @group Projects
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $projects = Projects::with('deploymentChecks')->get();

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($projects)
        ], 200);
    }

    /**
     * Create a new project
     * 
     * @group Projects
     * @return JsonResponse
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = Projects::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => new ProductResource($project)
        ], 201);
    }

    /**
     * Get project deployment readiness
     * 
     * @group Projects
     * @return JsonResponse
     */
    public function readiness(Projects $project): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new ProjectReadinessResource($project)
        ], 200);
    }

    /**
     * Add a deployment check to a project
     * 
     * @group Projects
     * @return JsonResponse
     */
    public function addCheck(Request $request, Projects $project): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $check = $project->deploymentChecks()->create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return response()->json([
            'success' => true,
            'data' => new DeploymentCheckResource($check)
        ], 201);
    }
}
