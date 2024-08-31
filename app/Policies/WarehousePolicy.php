<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Auth\Access\Response;

class WarehousePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Warehouse Staff');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Warehouse $warehouse): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Warehouse Staff');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Warehouse Staff');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Warehouse $warehouse): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Warehouse Staff');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Warehouse $warehouse): bool
    {
        return $user->hasRole('Admin');
    }
}
