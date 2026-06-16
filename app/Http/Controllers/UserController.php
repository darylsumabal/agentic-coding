<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\PaginateUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    // public function __construct(private readonly UserService $users) {}

    public function index(Request $request, PaginateUserAction $paginateUserAction)
    {
        // $users = $this->users->paginate($request->all());
        // $users = $paginateUserAction->execute($request->all());

        // return Inertia::render('users/Index', [
        //     'users' => UserResource::collection($users),
        // ]);

        // return UserResource::collection(User::all());
        return User::all()->toResourceCollection();
    }

    public function create(): Response
    {
        return Inertia::render('users/Create');
    }

    public function store(UserRequest $request, CreateUserAction $createUserAction): RedirectResponse
    {
        // $this->users->create($request->validated());
        $createUserAction->execute($request->validated());

        return redirect()->route('users.index');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('users/Edit', [
            'user' => UserResource::make($user),
        ]);
    }

    public function update(UserRequest $request, User $user, UpdateUserAction $updateUserAction): RedirectResponse
    {

        // $this->users->update($user, $request->validated());
        $updateUserAction->execute($user, $request->validated());

        return redirect()->route('users.index');
    }

    public function destroy(User $user, DeleteUserAction $deleteUserAction): RedirectResponse
    {
        // $this->users->delete($user);
        $deleteUserAction->execute($user);

        return redirect()->route('users.index');
    }
}
