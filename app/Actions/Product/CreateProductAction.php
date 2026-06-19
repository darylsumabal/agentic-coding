<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Models\User;
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
        return Product::create($attributes);
    }
}
