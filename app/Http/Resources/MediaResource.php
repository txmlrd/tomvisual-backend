<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "type" => $this->type,
            "url" => $this->url,
            "name" => $this->name,
            "created_at" => $this->created_at->translatedFormat('d F Y H:i:s'),
            "updated_at" => $this->updated_at->translatedFormat('d F Y H:i:s'),
        ];
    }
}
