<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    public function __construct(private readonly UserService $users) {}

    public function index(Request $request): Response
    {
        $users = $this->users->paginate($request->all());

        return Inertia::render('users/Index', [
            'users' => UserResource::collection($users),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('users/Create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->users->create($request->validated());

        return redirect()->route('users.index');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('users/Edit', [
            'user' => UserResource::make($user),
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {

        $this->users->update($user, $request->validated());

        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->users->delete($user);

        return redirect()->route('users.index');
    }
}
