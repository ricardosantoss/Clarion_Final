<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <x-slot name="leftFooter">
        Leia nossos <a href="#" class="underline">termos e condições</a>.
    </x-slot>

    <h2 class="text-3xl font-bold text-gray-800 mb-4">Esqueceu a senha?</h2>

    <div class="mb-4 text-sm text-gray-600">
        Sem problemas, informe seu e-mail e enviaremos um link para você criar uma nova senha.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="space-y-6">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                E-mail
            </label>
            <div class="mt-1">
                <x-text-input wire:model="email" id="email" class="block w-full"
                              type="email" name="email" required autofocus
                              placeholder="Digite seu e-mail" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-2">
                Enviar
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" wire:navigate
           class="text-sm font-medium text-gray-500 hover:text-gray-700">
            &larr; Voltar para o login
        </a>
    </div>
</div>
