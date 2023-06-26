<?php

namespace App\Policies;

use App\Models\User;

class BookmarkPolicy
{
    public function delete(User $user) {
        return !$user->isBlocked();
    }
}
