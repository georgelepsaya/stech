<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $admin, User $user) {
        return $admin->isAdmin() && !$user->isAdmin();
    }

    public function edit_interests(User $user) {
        return !$user->isBlocked();
    }

    public function follow(User $user) {
        return !$user->isBlocked();
    }
}
