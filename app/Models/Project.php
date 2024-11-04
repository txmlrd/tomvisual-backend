<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'main_image', 'project_type', 'year', 'content'
    ];
    
    /**
     * Get the user that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class, 'project_type', 'id');
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

}
