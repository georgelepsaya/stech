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

    # Contribution methods #
    
    // utility
    private function getContributor($user_id) {
        $contributorQuery = Contributor::
        where('user_id','=',$user_id)->
        where('page_id','=',$this->id)->
        where('page_type','=',2);
        $contributor = $contributorQuery->get();
        return ($contributor->isEmpty())? null : $contributor[0];
    }

    public function isContributor($user_id) {
        $contributor = $this->getContributor($user_id);
        return (is_null($contributor))? false : ($contributor->approved == 1);
    }

    public function requestedContribution($user_id) {
        return !is_null($this->getContributor($user_id));
    }
}
