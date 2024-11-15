<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'name',
        'type'
    ];

    public function project()
    {
        return $this->belongsToMany(Project::class, 'project_media');
    }
}
