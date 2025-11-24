<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

/*Route::view('dashboard', 'dashboard')
    //->middleware(['auth', 'verified'])
    ->name('dashboard');*/

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Rota para o Dashboard (você já deve ter)
// Volt::route('/', 'dashboard')->name('dashboard');
Volt::route('dashboard', 'pages.dashboard')
    ->name('dashboard');

// --- ADICIONE ESTAS 3 ROTAS ---
Volt::route('peticoes/gerar', 'pages.peticoes.gerar')
    ->name('peticoes.gerar');

Volt::route('peticoes/revisao', 'pages.peticoes.revisao')
    ->name('peticoes.revisao');

Volt::route('peticoes/historico', 'pages.peticoes.historico')
    ->name('peticoes.historico');

require __DIR__.'/auth.php';
