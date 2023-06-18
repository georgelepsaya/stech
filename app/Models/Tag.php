<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    public function companyPages() {
        return $this->belongsToMany(CompanyPage::class, 'company_page_tag', 'tag_id', 'page_id');
    }

    public function productPages() {
        return $this->belongsToMany(ProductPage::class, 'product_page_tag', 'tag_id', 'page_id');
    }

    public function topicPages() {
        return $this->belongsToMany(ProductPage::class, 'topic_page_tag', 'tag_id', 'page_id');
    }
}
