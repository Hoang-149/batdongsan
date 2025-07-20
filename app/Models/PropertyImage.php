<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    // use HasFactory;

    protected $table = 'property_images';
    protected $primaryKey = 'image_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['property_id', 'image_url'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }
}
