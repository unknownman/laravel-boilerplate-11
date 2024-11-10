<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'slug', 'parent_id', 'user_id'];

    public function children() {
        return $this->hasMany(Category::class, "parent_id");
    }

    public function parent() {
        return $this->belongsTo(Category::class, "parent_id");
    }

    public function posts() {
        return $this->morphedByMany(Post::class, "categorizable");
    }

    public function pages() {
        return $this->morphedByMany(Page::class, "categorizable");
    }
}
