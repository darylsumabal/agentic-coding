<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use Illuminate\Http\Request;

class JsonPlaceHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private readonly TodoService $todoService) {}

    public function index()
    {
        $todos = $this->todoService->getAll();
        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        $todo = $this->todoService->create($request->validated());
        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request, int $id)
    {
        $todo = $this->todoService->update((int)$id, $request->validated());
        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->todoService->delete((int)$id);
        return response()->json(null, 204);
    }
}
