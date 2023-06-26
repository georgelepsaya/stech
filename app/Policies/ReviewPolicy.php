<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;

class ReviewPolicy
{
    public function update(User $user, Review $review) {
        return (!$user->isBlocked() && $review->isAuthor($user->id)) || $user->isAdmin();
    }

    public function delete(User $user, Review $review) {
        return (!$user->isBlocked() && $review->isAuthor($user->id)) || $user->isAdmin();
    }
}
