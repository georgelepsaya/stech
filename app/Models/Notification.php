<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function target(string $type) {
        switch($type) {
            case 'company':
                return $this->belongsTo(CompanyPage::class, 'target_id');
            case 'product':
                return $this->belongsTo(ProductPage::class, 'target_id');
            case 'topic':
                return $this->belongsTo(TopicPage::class, 'target_id');
        }
        
        return $this->hasMany(Review::class, 'article_id');
    }
}
