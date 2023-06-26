<?php

namespace App\Policies;

use App\Models\User;

class ContributorPolicy
{
    public function viewAny(User $user) {
        return $user->isAdmin();
    }

    public function create(User $user) {
        return !$user->isBlocked() && !$user->isAdmin();
    }

    public function update(User $user) {
        return $user->isAdmin();
    }
}
