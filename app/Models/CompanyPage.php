<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPage extends Model
{
    use HasFactory;

    protected $table = 'company_page';

    public function tags() {
        return $this->belongsToMany(Tag::class, 'company_page_tag', 'page_id', 'tag_id');
    }

    public function products() {
        return $this->hasMany(ProductPage::class, 'company_id');
    }

    public function isContributor($user_id) {
        $contributorQuery = Contributor::
        where('user_id','=',$user_id)->
        where('page_id','=',$this->id)->
        where('page_type','=',1);
        $contributor = $contributorQuery->get();
        return ($contributor->isEmpty())? false : ($contributor[0]->approved == 1);
    }
}
