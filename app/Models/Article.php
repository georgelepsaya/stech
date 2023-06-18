<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'article_id');
    }
}
