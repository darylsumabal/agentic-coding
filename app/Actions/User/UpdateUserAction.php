<?php

namespace App\Actions\User;

use App\Models\User;

class UpdateUserAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function execute(User $user, array $attributes)
    {
        return $user->update($attributes);
    }
}
