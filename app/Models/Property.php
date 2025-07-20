<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    // use HasFactory;
    protected $table = 'Properties';
    protected $primaryKey = 'property_id';
    public $incrementing = true;
    // public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type_id',
        'location_id',
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
    ];

    protected $dates = ['vip_expires_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'type_id', 'type_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
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
