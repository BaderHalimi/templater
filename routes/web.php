<?php

use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\HomePage;
use App\Livewire\Projects\ProjectForm;
use App\Livewire\Projects\ProjectIndex;
use App\Livewire\Projects\ProjectShow;
use Illuminate\Support\Facades\Route;

Route::livewire('/', HomePage::class)->name('home');

Route::middleware('guest')->group(function (): void {
    Route::livewire('/register', RegisterPage::class)->name('register');
    Route::livewire('/login', LoginPage::class)->name('login');
});

Route::middleware('auth')->group(function (): void {
    Route::livewire('/projects', ProjectIndex::class)->name('projects.index');
    Route::livewire('/projects/create', ProjectForm::class)->name('projects.create');
    Route::livewire('/projects/{project}/edit', ProjectForm::class)->name('projects.edit');
    Route::livewire('/projects/{project}', ProjectShow::class)->name('projects.show');
});
