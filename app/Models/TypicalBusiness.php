<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypicalBusiness extends Model
{
    use HasFactory;

    protected $table = 'typicalbusiness';
    protected $primaryKey = 'id';
    public $incrementing = true;
    // public $timestamps = false;

    protected $fillable = [
        'id',
        'image_url',
        'created_at',
        'updated_at',
    ];
}
