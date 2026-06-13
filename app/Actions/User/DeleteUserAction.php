<?php

namespace App\Actions\User;

use App\Models\User;

class DeleteUserAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function execute(User $user)
    {
        return $user->delete();
    }
}
