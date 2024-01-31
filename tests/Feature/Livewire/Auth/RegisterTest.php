<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

it('should render the component', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able to register a new in the system', function () {
    Livewire::test(Register::class)
        ->set('name', 'Joe Doe')
        ->set('email', 'joe@email.com')
        ->set('email_confirmation', 'joe@email.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'name'  => 'Joe Doe',
        'email' => 'joe@email.com',
    ]);

    assertDatabaseCount('users', 1);
});
