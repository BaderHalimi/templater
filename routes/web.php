<?php

use App\Http\Controllers\Auth\GoogleAuthenticatedSessionController;
use App\Livewire\Auth\LoginPage;
use App\Livewire\HomePage;
use App\Livewire\Projects\ProjectForm;
use App\Livewire\Projects\ProjectIndex;
use App\Livewire\Projects\ProjectShow;
use Illuminate\Support\Facades\Route;

Route::livewire('/', HomePage::class)->name('home');

Route::middleware('guest')->group(function (): void {
    Route::livewire('/login', LoginPage::class)->name('login');
    Route::redirect('/register', '/login')->name('register');
    Route::get('/auth/google/redirect', [GoogleAuthenticatedSessionController::class, 'redirect'])->name('auth.google.redirect');
    Route::get('/auth/google/callback', [GoogleAuthenticatedSessionController::class, 'callback'])->name('auth.google.callback');
});

Route::middleware('auth')->group(function (): void {
    Route::livewire('/projects', ProjectIndex::class)->name('projects.index');
    Route::livewire('/projects/create', ProjectForm::class)->name('projects.create');
    Route::livewire('/projects/{project}/edit', ProjectForm::class)->name('projects.edit');
    Route::livewire('/projects/{project}', ProjectShow::class)->name('projects.show');
});
