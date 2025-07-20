<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'Projects';
    protected $primaryKey = 'project_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['project_name', 'location_id', 'description', 'developer_name', 'start_date', 'completion_date'];
}
