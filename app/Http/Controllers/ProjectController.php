<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Media;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectDetailResource;
use App\Models\ProjectType;
use App\Http\Resources\ProjectTypeResource;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            $projects = Project::all();
            if ($request->has('type')) {
                $projects = Project::where('project_type', $request->query("type"))->get();
            }
            if ($projects->isEmpty()) {
                return response()->json([
                    'message' => 'Projects not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Projects not found',
                'error' => $e->getMessage()
            ], 404);
        }

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
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'project_type' => 'required|exists:project_types,id', // Pastikan project_type valid
            'year' => 'required|integer',
            'content' => 'required|string',
            'media.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $imagename = date('YdmHis') . '.' . $request->main_image->extension();
        $imageNamePath = 'images/' . $imagename;
        Storage::putFileAs('public/images', $request->main_image, $imagename);
        $validate['main_image'] = $imageNamePath;

        // Buat proyek baru
        $project = Project::create([
            'title' => $request->title,
            'main_image' => $imageNamePath,
            'project_type' => $request->project_type,
            'year' => $request->year,
            'content' => $request->content,
        ]);

        $filePaths = [];
        foreach ($request->file('logo') as $file) {
            $imagename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $imagePath = 'public/images/logo/' . $imagename;

            Storage::putFileAs('public/images/logo', $file, $imagename);
            $image = new Media();
            $image->url = 'images/logo/' . $imagename;
            $image->project_id = $project->id;
            $image->save();
            $filePaths[] = Storage::url($image->url);
        }

        return new ProjectResource($project); // Kembalikan resource proyek
    }

    public function store_type(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project_type = ProjectType::create($validated);

        return new ProjectTypeResource($project_type);
    }
    public function show_type()
    {
        $project_type = ProjectType::all();
        return ProjectTypeResource::collection($project_type);
    }
}
