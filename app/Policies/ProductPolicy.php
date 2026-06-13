<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;


class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isManager() || $user->isUser();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->isAdmin() || $user->isManager() || $user->isUser()    ;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function restore(User $user, Product $product): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function forceDelete(User $user, Product $product): bool
    {
        return $user->isAdmin() || $user->isManager();
    }
}
