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
}
