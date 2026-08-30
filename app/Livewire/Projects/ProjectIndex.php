<?php

namespace App\Livewire\Projects;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProjectIndex extends Component
{
    public function render(): View
    {
        return view('livewire.projects.project-index', [
            'projects' => auth()->user()->invitationProjects()->latest()->get(),
        ]);
    }
}
