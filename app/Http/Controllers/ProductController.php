<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateProductAction;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return ProductResource::collection(Product::with('users')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateProductAction $createProductAction)
    {
        $validate = $request->validate([
            'team_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        try {
            // Run the action
            $createProductAction->execute($validate);

            // Return JSON success response
            return response()->json([
                'message' => 'Product created successfully!',
            ], 201);
        } catch (\Throwable $th) {
            // Return JSON exception error response if something went wrong
            return response()->json([
                'message' => 'Failed to create product.',
                'error'   => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
