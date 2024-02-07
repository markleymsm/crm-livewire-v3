<?php

namespace App\Livewire\Auth\Password;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Reset extends Component
{
    public ?string $token = null;

    public ?string $email = null;

    public function mount(): void
    {
        $this->token = request()->get('token');
        $this->email = request()->get('email');
    }

    public function render(): View
    {
        return view('livewire.auth.password.reset');
    }
}
