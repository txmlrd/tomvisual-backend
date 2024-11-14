<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use App\Http\Resources\ProjectTypeResource;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $project_type = ProjectType::all();
        return ProjectTypeResource::collection($project_type);
    }
    public function store_type(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project_type = ProjectType::create($validated);

        return new ProjectTypeResource($project_type);
    }
}
