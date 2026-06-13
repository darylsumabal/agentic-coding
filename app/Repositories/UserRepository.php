<?php

namespace App\Repositories;

use App\Models\User;


class UserRepository implements UserRepositoryInterface
{

    public function paginateUser(array $attributes, int $perPage = 15)
    {
        return User::query()
            ->when($attributes['search'] ?? null, fn($q, $search) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            }))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Summary of createUser
     * @param array {name: string, email: string, password: string} $attributes
     */
    public function createUser(array $attributes)
    {
        return User::create($attributes);
    }

    /**
     * @param array<string,mixed> $attributes
     */
    public function updateUser(User $user, array $attributes)
    {
        return $user->update($attributes);
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
