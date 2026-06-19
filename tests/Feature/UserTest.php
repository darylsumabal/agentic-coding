<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutExceptionHandling;

test('index users', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('users.index'))
        ->assertStatus(200);
});

test('store user', function () {

    $user = User::factory()->create();

    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'type' => 'admin',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    actingAs($user)->post(route('users.store'), $data);

    assertDatabaseHas('users', [
        'email' => 'john@example.com'
    ]);
});

test('update user', function () {
    withoutExceptionHandling();
    $user = User::factory()->create();

    $data = [
        'name' => 'John Does updated',
        'email' => 'joshn@example.com',
        'type' => 'admin',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    actingAs($user)->put(route('users.update', $user), $data);

    assertDatabaseHas('users', [
        'id'    => $user->id,
        'name' => 'John Does updated',
        'email' => 'joshn@example.com',
    ]);
});
