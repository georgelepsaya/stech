<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPage extends Model
{
    use HasFactory;

    protected $table = 'product_page';

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_page_tag', 'page_id', 'tag_id');
    }

    public function company() {
        return $this->belongsTo(CompanyPage::class, 'company_id');
    }

    public function isContributor($user_id) {
        $contributorQuery = Contributor::
        where('user_id','=',$user_id)->
        where('page_id','=',$this->id)->
        where('page_type','=',2);
        $contributor = $contributorQuery->get();
        return ($contributor->isEmpty())? false : ($contributor[0]->approved == 1);
    }
}
