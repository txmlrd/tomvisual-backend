<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'main_image' => $this->main_image,
            'project_type' => new ProjectTypeResource($this->projectType),
            'year' => $this->year,
            'content' => $this->content,
            'created_at' => $this->created_at->translatedFormat('d F Y'),
        ];
    }
}
