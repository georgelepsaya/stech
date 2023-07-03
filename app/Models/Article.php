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

    public function isBookmarkedBy($user_id) {
        $bookmarkQuery = Bookmark::
        where('user_id','=',$user_id)->
        where('target_id','=',$this->id)->
        where('target_type','=',4);
        return !$bookmarkQuery->get()->isEmpty();
    }

    public function isAuthor($user_id) {
        return $this->user_id == $user_id;
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

}
