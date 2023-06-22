<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','target_id','target_type'];

    public static function isUnique(Request $request) {
        $bookmarkQuery = Bookmark::
        where('user_id','=',$request->user_id)->
        where('target_id','=',$request->target_id)->
        where('target_type','=',$request->target_type);
        return $bookmarkQuery->get()->isEmpty();
    }

    public static function findByCompositePK(Request $request) {
        $bookmarkQuery = Bookmark::
        where('user_id','=',$request->user_id)->
        where('target_id','=',$request->target_id)->
        where('target_type','=',$request->target_type);
        return $bookmarkQuery->get()[0];
    }

    public function getTarget() {
        $target = null;
        
        switch($this->target_type) {
            case 1:
                $target = CompanyPage::findOrFail($this->target_id);
                break;
            case 2:
                $target = ProductPage::findOrFail($this->target_id);
                break;
            case 3:
                $target = TopicPage::findOrFail($this->target_id);
                break;
            case 4:
                $target = Article::findOrFail($this->target_id);
        }
        return $target;
    }
}
