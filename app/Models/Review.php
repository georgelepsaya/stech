<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function article() {
        return $this->belongsTo(User::class, 'article_id');
    }
    
    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function isAuthor($user_id) {
        return $this->author_id == $user_id;
    }
}
