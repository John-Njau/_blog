<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // only allowed to fill in the php artisan tinker
    // protected $fillable = ['title', 'excerpt', 'body', 'id'];


//fillable fields
//protected $guarded = [];


//    look at conventions
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
