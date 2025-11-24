<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    // Propriedade para o campo de pesquisa
    public string $search = '';
}; ?>

<div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 100 C 20 80, 40 120, 60 80 S 80 120, 100 80 V 100 H 0 Z" fill="#4A5568"/>
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Total</span>
                <p class="text-4xl font-bold text-gray-800">67</p>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 100 C 20 80, 40 120, 60 80 S 80 120, 100 80 V 100 H 0 Z" fill="#10B981"/>
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Completas</span>
                <p class="text-4xl font-bold text-green-600">30</p>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 100 C 20 80, 40 120, 60 80 S 80 120, 100 80 V 100 H 0 Z" fill="#3B82F6"/>
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Em Progresso</span>
                <p class="text-4xl font-bold text-blue-600">7</p>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 100 C 20 80, 40 120, 60 80 S 80 120, 100 80 V 100 H 0 Z" fill="#FBBF24"/>
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Pendentes</span>
                <p class="text-4xl font-bold text-yellow-600">30</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md mt-6 overflow-hidden">

        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 p-6">

            <div class="flex items-center w-full md:w-auto">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    id="search"
                    class="block w-full md:w-72 pl-3 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Pesquise por cliente, petição, tipo de petição..."
                >
                {{--<button class="p-2.5 border border-gray-300 rounded-md text-gray-500 hover:bg-gray-50 ml-1">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                </button>--}}

                {{--<button class="flex items-center text-sm text-gray-600 hover:text-gray-900 py-2 px-4 rounded-md border ml-2">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.07 1.916l-1.123.632A2.25 2.25 0 019.02 18.375V15.45a2.25 2.25 0 00-.659-1.591l-5.432-5.432A2.25 2.25 0 012.25 6.844V5.8c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" /></svg>
                    Filtros
                </button>--}}
                <button class="flex items-center text-sm text-gray-600 hover:text-gray-900 py-2 px-4 rounded-md border ml-3 border-gray-300">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" /></svg>
                    Exportar
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petição</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Petição</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioridade</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">João Silva</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PET-2025-005</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ação de Cobrança</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Sucesso
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">...</td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Carlos Oliveira</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PET-2025-895</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ação Revisional</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Em Progresso...
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
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                Pendente
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">...</td>
                    </tr>
                    </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between px-6 py-4 border-t">
            <div class="text-sm text-gray-700">
                Mostrando <span class="font-medium">1</span> a <span class="font-medium">7</span> de <span class="font-medium">14</span> resultados
            </div>
            <div class="flex space-x-2">
                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
                    Anterior
                </button>
                <button class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700">
                    Próxima
                </button>
            </div>
        </div>
    </div>
</div>
