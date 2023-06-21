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
    
    public function isContributor($user_id) {
        $contributorQuery = Contributor::
        where('user_id','=',$user_id)->
        where('page_id','=',$this->id)->
        where('page_type','=',3);
        $contributor = $contributorQuery->get();
        return ($contributor->isEmpty())? false : ($contributor[0]->approved == 1);
    }
}
