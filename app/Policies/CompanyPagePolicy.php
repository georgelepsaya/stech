<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CompanyPage;

class CompanyPagePolicy
{
    public function view(User $user, CompanyPage $page) {
        return $page->isApproved() || $page->isContributor($user->id) || $user->isAdmin();
    }

    public function create(User $user) {
        return !$user->isBlocked();
    }

    public function update(User $user, CompanyPage $page) {
        return (!$user->isBlocked() && $page->isContributor($user->id)) || $user->isAdmin();
    }
    
    public function requestDeletion(User $user, CompanyPage $page) {
        return !$user->isBlocked() && $page->isContributor($user->id);
    }

    public function bookmark(User $user, CompanyPage $page) {
        return !$user->isBlocked() && !is_null($page) && $page->isApproved();
    }
}
