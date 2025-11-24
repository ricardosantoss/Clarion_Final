<?php

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    // --- ESTADO DO WIZARD ---
    public int $step = 1;

    // --- DADOS DOS PASSOS ---
    // Passo 1: Empresa (Campos atualizados)
    public string $razao_social = ''; // <-- ATUALIZADO
    public string $nome_fantasia = ''; // <-- NOVO
    public string $cnpj = '';

    // Passo 2: Usuário (Gestor)
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    // Passo 3: Finalização
    public string $token = '';
    public bool $terms = false;

    /**
     * Navega para o próximo passo após validar o passo atual.
     */
    public function nextStep(): void
    {
        $this->resetErrorBag();

        if ($this->step == 1) {
            // Validar Passo 1 (Regras atualizadas)
            $this->validate([
                'razao_social' => ['required', 'string', 'max:255'], // <-- ATUALIZADO
                'nome_fantasia' => ['nullable', 'string', 'max:255'], // <-- NOVO
                'cnpj' => ['required', 'string', 'max:18', 'unique:' . Empresa::class],
            ]);
        } elseif ($this->step == 2) {
            // Validar Passo 2
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        if ($this->step < 3) {
            $this->step++;
        }
    }

    /**
     * Retorna para o passo anterior.
     */
    public function previousStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    /**
     * Finaliza o cadastro
     */
    public function register(): void
    {
        // Valida todos os campos (Regras do Passo 1 atualizadas)
        $validated = $this->validate(
            [
                // Passo 1
                'razao_social' => ['required', 'string', 'max:255'], // <-- ATUALIZADO
                'nome_fantasia' => ['nullable', 'string', 'max:255'], // <-- NOVO
                'cnpj' => ['required', 'string', 'max:18', 'unique:' . Empresa::class],

                // Passo 2
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],

                // Passo 3
                'token' => ['required', 'string', Rule::in(['Cl4r10n'])],
                'terms' => ['required', 'accepted'],
            ],
            [
                'token.in' => 'O código de convite informado é inválido.',
            ],
        );

        // Transação do Banco de Dados
        DB::transaction(function () use ($validated) {
            // 1. Criar a Empresa (Campos atualizados)
            $empresa = Empresa::create([
                'razao_social' => $validated['razao_social'], // <-- ATUALIZADO
                'nome_fantasia' => $validated['nome_fantasia'], // <-- NOVO
                'cnpj' => $validated['cnpj'],
            ]);

            // 2. Criar o Usuário Gestor
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'empresa_id' => $empresa->id,
                'nivel_hierarquia' => 'Gestor',
            ]);

            // 3. Disparar evento e logar o usuário
            event(new Registered($user));
            Auth::login($user);
        });

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-slot name="leftFooter">
        Já possui conta?
        <a href="{{ route('login') }}" wire:navigate
            class="font-bold text-white px-4 py-2 border border-white rounded-md hover:bg-white hover:text-gray-800 transition-colors ml-2">
            Acessar
        </a>
    </x-slot>

    <h2 class="text-3xl font-bold text-gray-800 mb-6">Cadastro</h2>

    <nav class="flex items-center justify-between mb-8 text-sm font-medium">
        <span @class([
            'flex items-center',
            'font-bold text-gray-600' => $step >= 1,
            'text-gray-500' => $step < 1,
        ])>
            <span @class([
                'w-6 h-6 rounded-full flex items-center justify-center mr-2 text-xs',
                'bg-gray-600 text-white' => $step >= 1,
                'bg-gray-200 text-gray-600' => $step < 1,
            ])>1</span> Empresa
        </span>
        <div @class([
            'flex-1 h-0.5 mx-4',
            'bg-gray-600' => $step > 1,
            'bg-gray-200' => $step <= 1,
        ])></div>
        <span @class([
            'flex items-center',
            'font-bold text-gray-600' => $step >= 2,
            'text-gray-500' => $step < 2,
        ])>
            <span @class([
                'w-6 h-6 rounded-full flex items-center justify-center mr-2 text-xs',
                'bg-gray-600 text-white' => $step >= 2,
                'bg-gray-200 text-gray-600' => $step < 2,
            ])>2</span> Gestor
        </span>
        <div @class([
            'flex-1 h-0.5 mx-4',
            'bg-gray-600' => $step > 2,
            'bg-gray-200' => $step <= 2,
        ])></div>
        <span @class([
            'flex items-center',
            'font-bold text-gray-600' => $step == 3,
            'text-gray-500' => $step < 3,
        ])>
            <span @class([
                'w-6 h-6 rounded-full flex items-center justify-center mr-2 text-xs',
                'bg-gray-600 text-white' => $step == 3,
                'bg-gray-200 text-gray-600' => $step < 3,
            ])>3</span> Finalizar
        </span>
    </nav>


    <form class="space-y-4">

        <div x-data="{ show: @js($step == 1) }" x-show="show" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
            <h3 class="text-lg font-medium text-gray-700 border-b pb-2">Dados da Empresa</h3>

            <div class="mt-4">
                <label for="razao_social" class="block text-sm font-medium text-gray-700">Razão Social</label>
                <div class="mt-1">
                    <x-text-input wire:model.blur="razao_social" id="razao_social" class="block w-full" type="text"
                        name="razao_social" required placeholder="Digite a razão social" />
                </div>
                <x-input-error :messages="$errors->get('razao_social')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="nome_fantasia" class="block text-sm font-medium text-gray-700">Nome Fantasia
                    (Opcional)</label>
                <div class="mt-1">
                    <x-text-input wire:model.blur="nome_fantasia" id="nome_fantasia" class="block w-full" type="text"
                        name="nome_fantasia" placeholder="Digite o nome fantasia" />
                </div>
                <x-input-error :messages="$errors->get('nome_fantasia')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="cnpj" class="block text-sm font-medium text-gray-700">CNPJ</label>
                <div class="mt-1">
                    <x-text-input wire:model.blur="cnpj" id="cnpj" class="block w-full" type="text"
                        name="cnpj" required placeholder="Digite o número do CNPJ" />
                </div>
                <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
            </div>
        </div>

        <div x-data="{ show: @js($step == 2) }" x-show="show" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
            <h3 class="text-lg font-medium text-gray-700 border-b pb-2 pt-2">Seus Dados (Gestor)</h3>
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Seu Nome</label>
                <div class="mt-1">
                    <x-text-input wire:model.blur="name" id="name" class="block w-full" type="text"
                        name="name" required placeholder="Digite seu nome completo" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <div class="mt-1">
                    <x-text-input wire:model.blur="email" id="email" class="block w-full" type="email"
                        name="email" required autocomplete="username" placeholder="Digite seu e-mail" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <div class="mt-1">
                        <x-text-input wire:model.blur="password" id="password" class="block w-full" type="password"
                            name="password" required autocomplete="new-password" placeholder="Digite a senha" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                        Senha</label>
                    <div class="mt-1">
                        <x-text-input wire:model.blur="password_confirmation" id="password_confirmation"
                            class="block w-full" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Digite a senha" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <div x-data="{ show: @js($step == 3) }" x-show="show" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
            <h3 class="text-lg font-medium text-gray-700 border-b pb-2 pt-2">Controle</h3>
            <div class="mt-4">
                <label for="token" class="block text-sm font-medium text-gray-700">Código de Convite</label>
                <div class="mt-1">
                    <x-text-input wire:model.blur="token" id="token" class="block w-full" type="text"
                        name="token" required placeholder="Digite seu código de convite" />
                </div>
                <x-input-error :messages="$errors->get('token')" class="mt-2" />
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <input wire:model="terms" id="terms" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-500">
                    <label for="terms" class="ms-2 block text-sm text-gray-900">
                        Eu aceito os <a href="#" class="underline font-medium">termos</a> e a <a href="#"
                            class="underline font-medium">política de privacidade</a>.
                    </label>
                </div>
                <x-input-error :messages="$errors->get('terms')" class="mt-2" />
            </div>
        </div>

        <div class="pt-6 flex justify-between">
            <div>
                @if ($step > 1)
                    <button type="button" wire:click="previousStep"
                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Voltar
                    </button>
                @endif
            </div>
            <div>
                @if ($step < 3)
                    <button type="button" wire:click="nextStep"
                        class="rounded-md border border-transparent bg-gray-800 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Próximo
                    </button>
                @else
                    <button type="button" wire:click="register"
                        class="rounded-md border border-transparent bg-gray-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cadastrar
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>
