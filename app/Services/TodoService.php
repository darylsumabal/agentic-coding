<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TodoService
{
    /**
     * Create a new class instance.
     */

    protected string $baseUrl;
    public function __construct()
    {
        $this->baseUrl = config('services.jsonplaceholder.base_url');
    }

    public function getAll()
    {
        $response = Http::get("{$this->baseUrl}/todos");
        return $response->json();
    }

    public function getOne(int $id)
    {
        $response = Http::get("{$this->baseUrl}/todos/{$id}");
        return $response->json();
    }

    public function create(array $data)
    {
        $response = Http::post("{$this->baseUrl}/todos", $data);
        return $response->json();
    }

    public function update(int $id, array $data)
    {
        $response = Http::put("{$this->baseUrl}/todos/{$id}", $data);
        return $response->json();
    }

    public function delete(int $id)
    {
        $response = Http::delete("{$this->baseUrl}/todos/{$id}");
        return $response->json();
    }
}
