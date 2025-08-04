<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'News'; // tên bảng, Laravel sẽ tự suy ra nếu đúng quy tắc số nhiều

    protected $primaryKey = 'id';

    public $timestamps = true; // vì bạn có trường created_at và updated_at

    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'author',
        'is_verified'
    ];
}
