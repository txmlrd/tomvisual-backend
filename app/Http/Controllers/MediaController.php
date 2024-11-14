<?php

namespace App\Http\Controllers;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class MediaController extends Controller
{

    public function index(Request $request)
    {
        $media = Media::query();

        if ($request->has('type')) {
            $media = $media->where('type', $request->type);
        }

        return MediaResource::collection($media->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        try {
            $name = strtolower(str_replace(' ', '-', $request->name));
            $typeLowerCase = strtolower($request->type);
            $imageName = date('YmdHis') . '_' . $name . '.' . $request->image->extension();
            $imagePath = 'storage/images/' . $typeLowerCase . '/' . $imageName;

            // Simpan file logo di storage
            Storage::putFileAs('public/images/' . $typeLowerCase, $request->image, $imageName);

            // Simpan informasi file ke database
            $image = new Media();
            $image->url = $imagePath;
            $image->type = $typeLowerCase;
            $image->name = $name;
            $image->save();

            return response()->json([
                'message' => 'Media uploaded successfully',
                'data' => $image
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload media',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
