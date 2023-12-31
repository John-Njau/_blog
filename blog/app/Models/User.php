<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Collection; // Import the Collection class

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'username',
//        'email',
//        'password',
//    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // private mixed $roles;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

//    public function getUsernameAttribute($username)
//    {
//        return ucwords($username);
//    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    private $roles;

    public function __construct()
    {
        $this->roles = collect(); // Initialize roles as an empty collection
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
