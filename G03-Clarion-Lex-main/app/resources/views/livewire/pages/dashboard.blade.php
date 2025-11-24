<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {

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
                <span class="text-sm font-medium text-gray-500">Total de Petições</span>
                <p class="text-4xl font-bold text-gray-800">270</p>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-2xl shadow-md overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 80 C 20 120, 40 80, 60 120 S 80 80, 100 120 V 100 H 0 Z" fill="#3B82F6" />
                </svg>
            </div>
            <div class="relative z-10">
                <span class="text-sm font-medium text-gray-500">Petições em Progresso</span>
                <p class="text-4xl font-bold text-blue-600">25</p>
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
                <span class="text-sm font-medium text-gray-500">Taxa de Sucesso</span>
                <p class="text-4xl font-bold text-green-600">90%</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Petições Realizadas</h3>
                <button class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    Janeiro <span class="ml-1">&darr;</span>
                </button>
            </div>
            <div class="h-64"> {{-- Removido bg-gray-50 e centralização para o canvas --}}
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Sucesso das Petições</h3>
                <button class="text-gray-400 hover:text-gray-600">&vellip;</button>
            </div>
            <div class="h-64 flex items-center justify-center"> {{-- Removido bg-gray-50 para o canvas --}}
                <canvas id="pieChart" class="max-h-full max-w-full"></canvas>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span class="flex items-center"><span
                            class="w-3 h-3 rounded-full bg-gray-700 mr-2"></span>Positivo</span>
                    <span class="font-medium">150 <span class="text-green-500 text-xs">(+23.3%)</span></span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="flex items-center"><span
                            class="w-3 h-3 rounded-full bg-gray-300 mr-2"></span>Negativo</span>
                    <span class="font-medium">20 <span class="text-red-500 text-xs">(-5.23%)</span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-md mt-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Petições Recentes</h3>
            <div class="flex space-x-2">
                <button class="flex items-center text-sm text-gray-600 hover:text-gray-900 py-1 px-3 rounded-md border">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.07 1.916l-1.123.632A2.25 2.25 0 019.02 18.375V15.45a2.25 2.25 0 00-.659-1.591l-5.432-5.432A2.25 2.25 0 012.25 6.844V5.8c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                    Filtrar
                </button>
                <button class="flex items-center text-sm text-gray-600 hover:text-gray-900 py-1 px-3 rounded-md border">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    Exportar
                </button>
            </div>
        </div>

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
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo
                            de Petição</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data
                        </th>
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
                                Sucesso &check;
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Carlos Oliveira</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PET-2025-555</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ação Revisional</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Recusada &times;
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">José Alves</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PET-2025-357</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ação Revisional</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                Pendente &hellip;
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21/08/2025</td>
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
</div>
@push('scripts')
<script>
    // 1. Colocamos toda a lógica de inicialização em uma função
    function initDashboardCharts() {

        // 2. Verificação de segurança: Só executa se o Chart.js (window.Chart) estiver carregado
        if (typeof Chart === 'undefined') {
            console.error('Chart.js não foi encontrado. Verifique app.js e npm run dev.');
            return;
        }

        // --- Gráfico de Linha ---
        const lineCtx = document.getElementById('lineChart');
        if (lineCtx) {
            // 3. Prevenção de erro: Destrói gráfico antigo se ele já existir
            //    (útil para navegação wire:navigate)
            const existingLineChart = Chart.getChart(lineCtx);
            if (existingLineChart) {
                existingLineChart.destroy();
            }

            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15'],
                    datasets: [{
                        label: 'Petições',
                        data: [60, 45, 90, 70, 50, 130, 75, 40, 30, 45, 70],
                        fill: true,
                        borderColor: '#4A5568',
                        backgroundColor: '#CBD5E0',
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } },
                    plugins: { legend: { display: false } }
                }
            });
        }

        // --- Gráfico de Pizza ---
        const pieCtx = document.getElementById('pieChart');
        if (pieCtx) {
            // 3. Prevenção de erro: Destrói gráfico antigo
            const existingPieChart = Chart.getChart(pieCtx);
            if (existingPieChart) {
                existingPieChart.destroy();
            }

            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Positivo', 'Negativo'],
                    datasets: [{
                        data: [150, 20],
                        backgroundColor: ['#4A5568', '#CBD5E0'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        }
    }

    // 4. Executa a função nos eventos corretos

    // Executa no carregamento inicial da página
    document.addEventListener('DOMContentLoaded', () => {
        initDashboardCharts();
    });

    // Executa toda vez que o Livewire navega para esta página (SPA)
    document.addEventListener('livewire:navigated', () => {
        // Precisamos verificar se os elementos do gráfico estão na página
        // antes de tentar inicializá-los
        if (document.getElementById('lineChart')) {
            initDashboardCharts();
        }
    });
</script>
@endpush
