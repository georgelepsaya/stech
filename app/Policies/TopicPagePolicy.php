<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TopicPage;

class TopicPagePolicy
{
    public function view(User $user, TopicPage $page) {
        return $page->isApproved() || $page->isContributor($user->id) || $user->isAdmin();
    }

    public function create(User $user) {
        return !$user->isBlocked();
    }

    public function update(User $user, TopicPage $page) {
        return (!$user->isBlocked() && $page->isContributor($user->id)) || $user->isAdmin();
    }
    
    public function requestDeletion(User $user, TopicPage $page) {
        return !$user->isBlocked() && $page->isContributor($user->id);
    }

    public function delete(User $user) {
        return $user->isAdmin();
    }

    public function bookmark(User $user, TopicPage $page) {
        return !$user->isBlocked() && !is_null($page) && $page->isApproved();
    }
}
