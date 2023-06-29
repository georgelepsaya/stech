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

    # Contribution methods #

    // utility
    private function getContributor($user_id) {
        $contributorQuery = Contributor::
        where('user_id','=',$user_id)->
        where('page_id','=',$this->id)->
        where('page_type','=',3);
        $contributor = $contributorQuery->get();
        return ($contributor->isEmpty())? null : $contributor[0];
    }

    public function contributors() {
        return $this->hasManyThrough(
            User::class,
            Contributor::class,
            'page_id', // Foreign key on Contributor table...
            'id', // Foreign key on User table...
            'id', // Local key on CompanyPage table...
            'user_id' // Local key on Contributor table...
        )->where('page_type', 3);
    }

    public function countApprovedContributors() {
        return $this->contributors()->where('approved', 1)->count();
    }

    public function isContributor($user_id) {
        $contributor = $this->getContributor($user_id);
        return (is_null($contributor))? false : ($contributor->approved == 1);
    }

    public function requestedContribution($user_id) {
        return !is_null($this->getContributor($user_id));
    }

    public function isBookmarkedBy($user_id) {
        $bookmarkQuery = Bookmark::
        where('user_id','=',$user_id)->
        where('target_id','=',$this->id)->
        where('target_type','=',3);
        return !$bookmarkQuery->get()->isEmpty();
    }

    public function isApproved() {
        return $this->approved == 3;
    }
}
