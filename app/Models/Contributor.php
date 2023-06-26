<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contributor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','page_id','page_type','approved'];

    public static function isUnique(Request $request) {
        $contributorQuery = Contributor::where('user_id','=',$request->user_id)->
                                         where('page_id','=',$request->page_id)->
                                         where('page_type','=',$request->page_type);
        return $contributorQuery->get()->isEmpty();
    }

    public function getUser() {
        return $this->belongsTo(User::class, 'user_id')->get()[0];
    }

    public function getPage() {
        switch($this->page_type) {
            case 1:
                return $this->belongsTo(CompanyPage::class, 'page_id')->get()[0];
                break;
            case 2:
                return $this->belongsTo(ProductPage::class, 'page_id')->get()[0];
                break;
            case 3:
                return $this->belongsTo(TopicPage::class, 'page_id')->get()[0];
                break;
        }
    }
}
