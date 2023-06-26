<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    public function create(User $user) {
        return !$user->isBlocked();
    }

    public function update(User $user, Article $article) {
        return (!$user->isBlocked() && $article->isAuthor($user->id)) || $user->isAdmin();
    }
    
    public function delete(User $user, Article $article) {
        return (!$user->isBlocked() && $article->isAuthor($user->id)) || $user->isAdmin();
    }

    public function bookmark(User $user) {
        return !$user->isBlocked() && !is_null($article);
    }

    public function review(User $user, Article $article) {
        return !$user->isBlocked() && !$article->isAuthor($user->id);
    }
}
