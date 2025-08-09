<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';
    protected $primaryKey = 'project_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['project_name', 'location_id', 'description', 'user_id', 'area', 'price', 'location', 'is_verified', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id', 'project_id');
    }
}
