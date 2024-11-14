<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Media;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Query dasar untuk mengambil proyek
            $projectsQuery = Project::query();

            // Menambahkan filter berdasarkan 'type' jika ada
            if ($request->has('type')) {
                $projectsQuery->where('project_type', $request->query("type"));
            }

            // Mengambil proyek bersama dengan logo-logo terkait
            $projects = $projectsQuery->with('media')->get();  // Bisa diganti paginate() jika perlu

            // Jika tidak ada proyek yang ditemukan
            if ($projects->isEmpty()) {
                return response()->json([
                    'message' => 'Projects not found'
                ], 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Menangani error database secara lebih spesifik
            return response()->json([
                'message' => 'Database query failed',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Menangani error lainnya
            return response()->json([
                'message' => 'An error occurred while fetching projects',
                'error' => $e->getMessage()
            ], 500);
        }

        // Mengembalikan proyek dalam format resource collection
        return ProjectResource::collection($projects);
    }


    public function show($id)
    {
        try {
            $project = Project::with('projectType')->findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }
        return new ProjectResource($project);
    }



    public function store(Request $request)
    {
        // Validasi request jika perlu
        $request->validate([
            'title' => 'required|string|max:255',
            'project_type' => 'required|exists:project_types,id', // Pastikan project_type valid
            'year' => 'required|integer',
            'content' => 'required|string',
            'url' => 'required|string',
            'media_id' => 'required|array',
            'media_id.*' => 'exists:media,id',
        ]);

        // Buat proyek baru
        $project = Project::create([
            'title' => $request->title,
            'project_type' => $request->project_type,
            'year' => $request->year,
            'content' => $request->content,
            'url' => $request->url,
        ]);

        $filePaths = [];
        $project->media()->attach($request->media_id);

        return new ProjectResource($project);
    }
}
