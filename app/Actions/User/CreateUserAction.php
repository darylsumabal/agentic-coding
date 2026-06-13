<?php

namespace App\Actions\User;

use App\Models\User;

class CreateUserAction
{
    //Example Usage
    // public function __construct(
    //     protected CreateUserAction $createUserAction,
    //     protected AssignDefaultRolesAction $assignRolesAction,
    //     protected SendWelcomeNotificationAction $sendNotificationAction
    // ) {}

    public function execute(array $attributes)
    {
        return User::create($attributes);
    }
}
