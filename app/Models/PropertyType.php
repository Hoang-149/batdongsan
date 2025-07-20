<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $table = 'PropertyTypes';
    protected $primaryKey = 'type_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['type_name', 'description'];
}
