<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy
{
    /**
     * Determine whether the user can view any models.
    */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager') || $user->hasRole('procurement_officer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager') || $user->hasRole('procurement_officer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('admin');
    }
}
