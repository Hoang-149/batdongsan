<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVip extends Model
{
    protected $table = 'uservip';

    protected $primaryKey = 'user_vip_id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'vip_level_id',
        'start_date',
        'end_date',
        'status',
        'credits_remaining',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'credits_remaining' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function vipLevel()
    {
        return $this->belongsTo(VipLevel::class, 'vip_level_id', 'vip_level_id');
    }
}
