<?php

namespace App\Models;

use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use HasComments;

    protected $fillable = ['title', 'description', 'content', 'slug'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postComments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('commentable_type', Post::class);
    }

    public function latestComment()
    {
        return $this->morphOne(Comment::class, 'commentable')->latestOfMany();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }

    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    public function categories() {
        return $this->morphToMany(Category::class, "categorizable");
    }
}
