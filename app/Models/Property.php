<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    // use HasFactory;
    protected $table = 'properties';
    protected $primaryKey = 'property_id';
    public $incrementing = true;
    // public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type_id',
        'project_id',
        'title',
        'description',
        'price',
        'area',
        'is_for_sale',
        'is_verified',
        'vip_expires_at',
        'created_at',
        'updated_at',
        'location',
        'demande',
        'title_seo',
        'content_seo',
        'description_seo'
    ];

    protected $dates = ['vip_expires_at', 'created_at', 'updated_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-'); // VD: "Dự án ABC" -> "du-an-abc"
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class, 'propertytypeproperty', 'property_id', 'type_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function isVipActive()
    {
        return $this->vip_expires_at && $this->vip_expires_at->isFuture();
    }
    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id', 'property_id');
    }
}
