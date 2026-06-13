<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;


class UserService
{
    /**
     * Constructor.
     */
    public function __construct(
        private readonly UserRepositoryInterface $user
    ) {}

    public function paginate(array $attributes): LengthAwarePaginator
    {
        return $this->user->paginateUser($attributes);
    }

    public function create(array $attributes): User
    {
        $attributes['password'] = Hash::make($attributes['password']);

        return $this->user->createUser($attributes);
    }

    public function update(User $user, array $attributes): bool
    {
        if (empty($attributes['password'])) {
            unset($attributes['password']);
        } else {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return $this->user->updateUser($user, $attributes);
    }

    public function delete(User $user): bool
    {
        return $this->user->deleteUser($user);
    }
}
