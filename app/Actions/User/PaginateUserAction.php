<?php

namespace App\Actions\User;

use App\Models\User;

class PaginateUserAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function execute(array $attributes, int $perPage = 15)
    {
        return User::query()
            ->when($attributes['search'] ?? null, fn($q, $search) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
