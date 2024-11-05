<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'mime_type',
        'size',
        'alt_text',
        'title',
        'description'
    ];

    public function mediable()
    {
        return $this->morphTo();
    }
}
