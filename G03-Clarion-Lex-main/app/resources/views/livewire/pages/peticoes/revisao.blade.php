<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    /**
     * Controla a aba ativa. Pode ser 'pendente' ou 'recente'.
     */
    public string $tab = 'pendente';

    /**
     * Define a aba ativa.
     */
    public function setTab(string $tab): void
    {
        $this->tab = $tab;
    }
}; ?>

<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 100 C 20 80, 40 120, 60 80 S 80 120, 100 80 V 100 H 0 Z" fill="#4A5568" />
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Total de Revisões</span>
                <p class="text-4xl font-bold text-gray-800">270</p>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20"> <svg class="w-full h-full" viewBox="0 0 100 100"
                    preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 80 C 20 120, 40 80, 60 120 S 80 80, 100 120 V 100 H 0 Z" fill="#FBBF24" />
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Revisões Pendentes</span>
                <p class="text-4xl font-bold text-yellow-600">7</p>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 100 C 20 80, 40 120, 60 80 S 80 120, 100 80 V 100 H 0 Z" fill="#10B981" />
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Revisões Recentes</span>
                <p class="text-4xl font-bold text-green-600">30</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md mt-6">

        <div class="border-b border-gray-200">
            <nav class="flex -mb-px" aria-label="Tabs">
                <button wire:click="setTab('pendente')" @class([
                    'w-1/2 py-4 px-6 text-center font-medium text-sm',
                    'border-b-2 border-gray-600 text-gray-600' => $tab === 'pendente',
                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' =>
                        $tab !== 'pendente',
                ])>
                    Revisão Pendente
                </button>

                <button wire:click="setTab('recente')" @class([
                    'w-1/2 py-4 px-6 text-center font-medium text-sm',
                    'border-b-2 border-gray-600 text-gray-600' => $tab === 'recente',
                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' =>
                        $tab !== 'recente',
                ])>
                    Revisão Recente
                </button>
            </nav>
        </div>

        <div x-show="$wire.tab === 'pendente'" x-transition class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cliente</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Petição</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo de Petição</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Prioridade</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">João Silva</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PET-2025-005</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ação de Cobrança</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Baixo
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">...</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Carlos Oliveira
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PET-2025-895</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ação Revisional</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Alto
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">...</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">José Alves</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PET-2025-456</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ação Revisional</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Médio
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-4 py-3 sm:px-6 border-t mt-4">
                <div class="text-sm text-gray-700">
                    Mostrando <span class="font-medium">1</span> a <span class="font-medium">7</span> de <span
                        class="font-medium">14</span> resultados
                </div>
                <div class="flex space-x-2">
                    <button
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
                        disabled>
                        Anterior
                    </button>
                    <button
                        class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700">
                        Próxima
                    </button>
                </div>
            </div>
        </div>

        <div x-show="$wire.tab === 'recente'" x-transition class="p-6">
            <p class="text-gray-500">Aqui será exibida a tabela de revisões recentes.</p>
        </div>

    </div>
</div>
