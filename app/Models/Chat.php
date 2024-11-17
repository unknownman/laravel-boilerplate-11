<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    use HasFactory;
    public $fillable = ["text", "from_id", "to_id"];

    public function from() {
        return $this->belongsTo(User::class, "from_id");
    }
    public function to() {
        return $this->belongsTo(User::class, "to_id");
    }
}
