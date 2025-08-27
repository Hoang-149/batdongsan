<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipLevel extends Model
{
    protected $table = 'viplevels';

    protected $primaryKey = 'vip_level_id';

    protected $fillable = [
        'level_name',
        'fee',
        'credit_card_num',
        'description',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function userVips()
    {
        return $this->hasMany(UserVip::class, 'vip_level_id', 'vip_level_id');
    }
}
