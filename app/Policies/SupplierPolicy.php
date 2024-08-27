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
        return $user->hasRole('Admin') || $user->hasRole('Inventory Manager') || $user->hasRole('Procurement Officer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Inventory Manager') || $user->hasRole('Procurement Officer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Inventory Manager');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Inventory Manager');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('Admin');
    }
}
