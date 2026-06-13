<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function paginateUser(array $attributes, int $perPage = 15);
    public function createUser(array $attributes);
    public function updateUser(User $user, array $attributes);
    public function deleteUser(User $user);
}
