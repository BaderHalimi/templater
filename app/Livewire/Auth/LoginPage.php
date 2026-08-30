<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class LoginPage extends Component
{
    public function render(): View
    {
        return view('livewire.auth.login-page');
    }
}
