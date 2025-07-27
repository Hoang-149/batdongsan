<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Table name is 'Users' (case-sensitive)
    protected $primaryKey = 'user_id'; // Primary key is 'user_id'
    public $incrementing = true; // Auto-incrementing primary key
    // public $timestamps = false; // Disable Laravel's default timestamps

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'full_name',
        'phone_number',
        'is_verified',
        'created_at',
        'updated_at',
    ];

    /**
     * Set the password_hash attribute and hash the password.
     *
     * @param string $value
     */
    public function setPasswordHashAttribute($value)
    {
        $this->attributes['password_hash'] = Hash::make($value);
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'userroles', 'user_id', 'role_id');
    }

    public function broker()
    {
        return $this->hasOne(Broker::class, 'user_id', 'user_id');
    }
}
