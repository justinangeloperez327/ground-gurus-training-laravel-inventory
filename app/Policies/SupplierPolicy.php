<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager') || $user->hasRole('procurement_officer');
    }

    public function view(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager') || $user->hasRole('procurement_officer');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager');
    }

    public function update(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('admin') || $user->hasRole('inventory_manager');
    }

    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('admin');
    }
}
