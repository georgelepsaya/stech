<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function companyPages() {
        return $this->belongsToMany(CompanyPage::class, 'company_page_tag', 'tag_id', 'page_id');
    }
}
