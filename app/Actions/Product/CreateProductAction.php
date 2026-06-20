<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateProductAction
{
    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    public function execute(array $attributes)
    {
        $user = Auth::id();

        // if (!$user) {
        //     throw new \Illuminate\Auth\AuthenticationException('Unauthenticated.');
        // }

        $product = Product::create($attributes);
        $product->users()->attach($user, [
            'quantity' => 1
        ]);

        return $product;
    }
}
