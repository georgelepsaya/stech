<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicPage extends Model
{
    use HasFactory;

    protected $table = 'topic_page';

    public function tags() {
        return $this->belongsToMany(Tag::class, 'topic_page_tag', 'page_id', 'tag_id');
    }
}
