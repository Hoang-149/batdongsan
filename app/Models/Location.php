<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'Locations';
    protected $primaryKey = 'location_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['province', 'district', 'ward', 'address_details'];
}
