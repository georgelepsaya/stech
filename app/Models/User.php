<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'user_tag', 'user_id', 'tag_id');
    }

    public function articles() {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follows_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follows_id', 'user_id');
    }

    public function isBlocked() {
        return $this->blocked == 1;
    }

    public function isAdmin() {
        return $this->admin == 1;
    }

    public function companyPages()
    {
        return $this->hasManyThrough(
            CompanyPage::class,
            Contributor::class,
            'user_id', // Foreign key on Contributor table...
            'id', // Foreign key on CompanyPage table...
            'id', // Local key on User table...
            'page_id' // Local key on Contributor table...
        )
            ->where('contributors.page_type', 1)
            ->where('contributors.approved', 1);
    }


    public function productPages()
    {
        return $this->hasManyThrough(
            ProductPage::class,
            Contributor::class,
            'user_id', // Foreign key on Contributor table...
            'id', // Foreign key on CompanyPage table...
            'id', // Local key on User table...
            'page_id' // Local key on Contributor table...
        )
            ->where('contributors.page_type', 2)
            ->where('contributors.approved', 2);
    }


    public function topicPages()
    {
        return $this->hasManyThrough(
            TopicPage::class,
            Contributor::class,
            'user_id', // Foreign key on Contributor table...
            'id', // Foreign key on CompanyPage table...
            'id', // Local key on User table...
            'page_id' // Local key on Contributor table...
        )
            ->where('contributors.page_type', 3)
            ->where('contributors.approved', 4);
    }

}
