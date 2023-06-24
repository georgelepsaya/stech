<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_id',
        'source_type',
        'subject_id',
        'subject_type',
        'notification_type'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function source() {
        return $this->morphTo();
    }

    public function subject() {
        return $this->morphTo();
    }
}
