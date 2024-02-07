<?php

use App\Livewire\Auth\Password\{Recovery, Reset};
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

use function Pest\Laravel\get;

test('i need to have a route that will receive the token and the email that needs to be reset it', function () {
    get(route('password.reset'))
        ->assertSeeLivewire('auth.password.reset');
});

test('need to receive a valid token with a combination with the email', function () {
    $user = User::factory()->create();

    Livewire::test(Recovery::class)
        ->set('email', $user->email)
        ->call('startPasswordRecovery');

    $token = DB::table('password_reset_tokens')
        ->where('email', '=', $user->email)
        ->first();

    get(route('password.reset'), ['token' => $token->token, 'email' => $token->email])
        ->assertOk();

    // get(route('password.reset'), ['token' => 'any-token', 'email' => $token->email])
    // ->assertRedirect();
});
