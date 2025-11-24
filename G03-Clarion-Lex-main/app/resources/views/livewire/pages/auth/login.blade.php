<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-slot name="leftFooter">
        Não tem uma conta?
        <a href="{{ route('register') }}" wire:navigate class="font-bold text-white underline hover:text-gray-200">
            Vamos começar!
        </a>
        <div class="mt-8">
            Leia nossos <a href="#" class="underline">termos e condições</a>.
        </div>
    </x-slot>

    <div class="flex justify-center mb-6">
        {{--<h1 class="text-3xl font-bold text-gray-700">Clarion</h1>--}}
        <img src="{{ asset('storage/img/logo_escrito.png') }}" alt="Clarion Logo" class="h-14"> {{-- Ajuste h-10 conforme necessário --}}
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-1 text-start">Login</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="mt-4 space-y-6">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                E-mail
            </label>
            <div class="mt-1">
                <x-text-input wire:model="form.email" id="email" class="block w-full"
                              type="email" name="email" required autofocus
                              autocomplete="username" placeholder="Digite seu e-mail" />
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Senha
            </label>
            <div class="mt-1">
                <x-text-input wire:model="form.password" id="password" class="block w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"
                              placeholder="Digite sua senha" />
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-500" name="remember">
                <label for="remember" class="ms-2 block text-sm text-gray-900">
                    Manter conectado
                </label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a class="font-medium text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}" wire:navigate>
                        Esqueceu a senha?
                    </a>
                </div>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-2">
                Acessar
            </x-primary-button>
        </div>
    </form>
</div>
