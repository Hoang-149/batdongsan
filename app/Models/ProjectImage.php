<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    // use HasFactory;

    protected $table = 'project_images';
    protected $primaryKey = 'image_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['project_id', 'image_url'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
}
