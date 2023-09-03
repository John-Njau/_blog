<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // only allowed to fill in the php artisan tinker
    // protected $fillable = ['title', 'excerpt', 'body', 'id'];


    // specifies which fields are not allowed to be filled in
    // protected $guarded = ['id'];

    // disables mass assignment entirely
//    protected $guarded = [];

//    query posts with category and author
    protected $with = ['category', 'author'];

//    query scope
public function scopeFilter($query, array $filters){
//    if (request('search')) {
//        $query->where('title', 'like', '%' . request('search') . '%')
//            ->orWhere('body', 'like', '%' . request('search') . '%');
//    }

    $query->when($filters['search'] ?? false, fn($query, $search) =>
        $query->where(fn($query) =>
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
        )
    );

    $query->when($filters['category'] ?? false, fn($query, $category) =>
        $query->whereHas('category', fn($query) =>
            $query->where('slug', $category)
        )
    );

    $query->when($filters['author'] ?? false, fn($query, $author) =>
        $query->whereHas('author', fn($query) =>
            $query->where('username', $author)
        )
    );
}

//comments relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // category relationship -- Eloquent relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//    user relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
