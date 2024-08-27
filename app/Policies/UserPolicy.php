<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasRole('Admin');
    }
}
