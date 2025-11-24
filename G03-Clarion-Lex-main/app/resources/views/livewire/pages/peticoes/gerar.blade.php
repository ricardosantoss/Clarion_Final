<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    // --- ESTADO DO WIZARD ---
    public int $step = 1;
    public bool $isLoading = false;

    // --- DADOS DO PASSO 1 (FORMULÁRIO) ---
    public $files = [];
    public string $tipoPeticao = '';
    public string $parteRepresentada = '';
    public string $instrucoes = '';

    // --- DADOS DOS PASSOS 2-5 (RESULTADOS DA IA) ---
    public string $jurisprudencia = '';
    public string $textoEscritor = '';
    public string $textoRevisor = '';
    public string $textoFinal = '';

    // --- Placeholders (Dados Fictícios) ---
    private string $placeholderJurisprudencia = "
        <h4 class='font-bold text-gray-800'>LEI Nº 12.527, DE 18 DE NOVEMBRO DE 2011</h4>
        <p class='text-gray-600'>Regula o acesso a informações previsto no inciso XXXIII do art. 5º, no inciso II do § 3º do art. 37 e no § 2º do art. 216 da Constituição Federal; altera a Lei nº 8.112, de 11 de dezembro de 1990; revoga a Lei nº 11.111, de 5 de maio de 2005, e dispositivos da Lei nº 8.159, de 8 de janeiro de 1991; e dá outras providências.</p>
        <h4 class='font-bold text-gray-800 mt-4'>DECRETO Nº 7.724, DE 16 DE MAIO DE 2012</h4>
        <p class='text-gray-600'>Art. 1º Este Decreto regulamenta, no âmbito do Poder Executivo federal, os procedimentos para a garantia do acesso à informação e para a classificação de informações sob restrição de acesso, observados grau e prazo de sigilo, conforme o disposto na Lei nº 12.527, de 18 de novembro de 2011, que dispõe sobre o acesso a informações previsto no inciso XXXIII do caput do art. 5º, no inciso II do § 3º do art. 37 e no § 2º do art. 216 da Constituição.</p>
    ";
    private string $placeholderTexto = "
        <p><strong>EXCELENTÍSSIMO SENHOR DOUTOR JUIZ DE DIREITO DA .... VARA CÍVEL DA COMARCA DE [CIDADE/UF]</strong></p>
        <br>
        <p>[NOME DO AUTOR], nacionalidade, estado civil, profissão, portador do RG nº [número] e CPF nº [número], residente e domiciliado na [endereço completo], por seu advogado (instrumento de mandato anexo), com escritório profissional na [endereço do advogado], onde recebe intimações, vem, respeitosamente, propor a presente</p>
        <p class='font-bold mt-2'>AÇÃO DE COBRANÇA</p>
        <p>com fundamento nos artigos 389, 395, 394 e seguintes do Código Civil e artigos 319 e seguintes do Código de Processo Civil, em face de:</p>
        <p>[NOME DO RÉU], nacionalidade, estado civil, profissão, portador do RG nº [número] e CPF nº [número], residente e domiciliado na [endereço completo], pelos motivos de fato e de direito a seguir expostos:</p>
        <br>
        <p class='font-bold'>I – DOS FATOS</p>
        <ol class='list-decimal list-inside ml-4'>
            <li>O Autor celebrou com o Réu, em [data], contrato de prestação de serviços [documento anexo], no valor total de R$ [valor], com vencimento previsto para o dia [data de vencimento].</li>
            <li>O serviço foi integralmente prestado pelo Autor, conforme comprovantes anexos (docs. __), não havendo qualquer apontamento de vício ou inadimplemento de sua parte.</li>
            <li>Contudo, o Réu não efetuou o pagamento devido, mesmo após diversas tentativas amigáveis de cobrança.</li>
        </ol>
        <br>
        <p class='font-bold'>II – DO DIREITO</p>
        <ol class='list-decimal list-inside ml-4' start='4'>
            <li>Nos termos do artigo 389 do Código Civil, o devedor que não cumpre a obrigação responde por perdas e danos, além de juros e correção monetária.</li>
            <li>O não pagamento da quantia devida configura inadimplemento contratual, sendo legítima a presente ação de cobrança.</li>
        </ol>
        <br>
        <p class='font-bold'>III – DOS PEDIDOS</p>
        <p>Diante do exposto, requer:</p>
        <ol class='list-alpha list-inside ml-4'>
            <li>A citação do Réu, no endereço supramencionado, para que, querendo, apresente contestação no prazo legal;</li>
            <li>A condenação do Réu ao pagamento da quantia de R$ [valor], acrescida de juros legais, correção monetária desde o vencimento da dívida e custas processuais;</li>
            <li>A condenação do Réu ao pagamento de honorários advocatícios, nos termos do art. 85 do CPC, em percentual a ser arbitrado por Vossa Excelência.</li>
        </ol>
        <p>Protesta provar o alegado por todos os meios de prova em direito admitidos, especialmente documental.</p>
        <p>Dá-se à causa o valor de R$ [valor].</p>
        <br>
        <p>Termos em que,<br>Pede deferimento.<br>[Cidade/UF], [data].</p>
    ";

    /**
     * PASSO 1: Envia o formulário e "inicia" a IA.
     */
    public function submitForm(): void
    {
        $this->validate([
            'tipoPeticao' => 'required',
            'parteRepresentada' => 'required',
            'instrucoes' => 'required|min:10',
            'files.*' => 'nullable|file|max:10240', // 10MB max por arquivo
        ]);

        $this->isLoading = true;

        // --- SIMULAÇÃO DA IA ---
        // No mundo real, você faria chamadas de API aqui
        // e usaria $wire.poll para verificar o status.
        // Para esta demo, apenas preenchemos os dados.

        // sleep(2); // Simula a "Pesquisa de jurisprudências"
        $this->jurisprudencia = $this->placeholderJurisprudencia;

        // sleep(2); // Simula o "Agente Escritor"
        $this->textoEscritor = $this->placeholderTexto;

        // sleep(1); // Simula o "Agente Revisor"
        $this->textoRevisor = $this->placeholderTexto; // (Poderia ter leves alterações)

        // sleep(1); // Simula o "Revisor Ortográfico"
        $this->textoFinal = $this->placeholderTexto; // (Poderia ter outras alterações)
        // --- FIM DA SIMULAÇÃO ---

        // Após a simulação (que aqui é instantânea),
        // paramos o loading e avançamos para o passo 2.
        $this->isLoading = false;
        $this->step = 2; // Avança para "Passo 1 - Jurisprudência"
    }

    /**
     * Avança para o próximo passo (2 -> 3 -> 4 -> 5).
     */
    public function nextStep(): void
    {
        if ($this->step < 5) {
            $this->step++;
        }
    }

    /**
     * Reseta todo o processo para começar de novo.
     */
    public function resetProcess(): void
    {
        // Limpa todos os dados
        $this->step = 1;
        $this->isLoading = false;
        $this->files = [];
        $this->tipoPeticao = '';
        $this->parteRepresentada = '';
        $this->instrucoes = '';
        $this->jurisprudencia = '';
        $this->textoEscritor = '';
        $this->textoRevisor = '';
        $this->textoFinal = '';
    }
}; ?>

<div class="relative">
    <div class="relative bg-white p-6 rounded-2xl mb-6 shadow-md overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100 C 20 80, 40 120, 60 80 S 80 120, 100 80 V 100 H 0 Z" fill="#4A5568" />
            </svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gerar Petição</h1>
            <p class="text-gray-500">Criação automatizada de peças jurídicas.</p>
        </div>
    </div>

    <div wire:loading.flex wire:target="submitForm"
        class="absolute inset-0 z-30 flex items-center justify-center bg-white/80 backdrop-blur-sm">
        <div class="text-center">
            <svg class="animate-spin h-12 w-12 text-gray-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Gerando petição...</h3>
            <p class="mt-1 text-sm text-gray-600" wire:loading.text>Iniciando agentes...</p>

            {{-- Bônus: Simular os passos da IA no loading --}}
            <div class="mt-2 text-sm text-gray-500">
                <p wire:loading.delay.shortest>Pesquisando jurisprudências...</p>
                <p wire:loading.delay.short>Agente Escritor redigindo...</p>
                <p wire:loading.delay>Agente Revisor analisando...</p>
                <p wire:loading.delay.long>Agente Ortográfico corrigindo...</p>
            </div>
        </div>
    </div>

    <div class="space-y-6">

        <div x-show="$wire.step === 1" x-transition>
            <div class="bg-white p-4 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Anexar Documentos</h2>

                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label for="file-upload"
                        class="flex flex-col items-center justify-center w-full h-64
                        border-2 border-dashed border-gray-300
                        rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">

                        <svg width="93" height="68" viewBox="0 0 93 68" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M76.4647 17.8934C73.6208 11.9214 68.7127 6.96639 62.4925 3.78751C56.2722 0.608631 49.0831 -0.618704 42.0265 0.293582C34.97 1.20587 28.4355 4.20744 23.4242 8.83836C18.4129 13.4693 15.2014 19.4741 14.2818 25.9326C9.84417 26.9037 5.95139 29.3304 3.34267 32.7518C0.733949 36.1731 -0.409033 40.3509 0.130784 44.4916C0.6706 48.6324 2.85562 52.4478 6.2709 55.2133C9.68617 57.9788 14.0939 59.5017 18.6569 59.4929C19.8913 59.4929 21.0752 59.0448 21.9481 58.2471C22.8209 57.4494 23.3113 56.3675 23.3113 55.2394C23.3113 54.1113 22.8209 53.0294 21.9481 52.2317C21.0752 51.434 19.8913 50.9859 18.6569 50.9859C16.188 50.9859 13.8203 50.0896 12.0746 48.4942C10.3288 46.8988 9.34808 44.735 9.34808 42.4788C9.34808 40.2226 10.3288 38.0588 12.0746 36.4634C13.8203 34.868 16.188 33.9717 18.6569 33.9717C19.8913 33.9717 21.0752 33.5236 21.9481 32.7259C22.8209 31.9282 23.3113 30.8463 23.3113 29.7182C23.3232 24.6875 25.2861 19.8234 28.8513 15.9903C32.4165 12.1571 37.3532 9.60304 42.7842 8.78178C48.2152 7.96052 53.789 8.92526 58.5153 11.5046C63.2415 14.084 66.8143 18.1109 68.5987 22.87C68.8648 23.6009 69.343 24.2521 69.9824 24.754C70.6218 25.256 71.3984 25.5898 72.2292 25.7199C75.3293 26.2553 78.1397 27.7344 80.2023 29.9161C82.2649 32.0979 83.4582 34.8537 83.5878 37.7346C83.7173 40.6154 82.7755 43.4515 80.9157 45.7805C79.0559 48.1096 76.3878 49.7945 73.3462 50.5605C72.1488 50.8425 71.1231 51.5477 70.4946 52.5209C69.8661 53.4941 69.6864 54.6556 69.995 55.7498C70.3037 56.8441 71.0753 57.7815 72.1402 58.3558C73.2051 58.9302 74.476 59.0944 75.6734 58.8124C80.5717 57.6295 84.9137 55.0182 88.0402 51.3749C91.1667 47.7317 92.9068 43.2555 92.9964 38.6262C93.0859 33.997 91.5199 29.4674 88.5362 25.7255C85.5525 21.9836 81.3141 19.2337 76.4647 17.8934ZM49.888 26.6982C49.4453 26.311 48.9234 26.0074 48.352 25.805C47.2189 25.3795 45.9479 25.3795 44.8147 25.805C44.2434 26.0074 43.7214 26.311 43.2787 26.6982L29.3155 39.4588C28.4391 40.2598 27.9467 41.3461 27.9467 42.4788C27.9467 43.6115 28.4391 44.6979 29.3155 45.4988C30.1919 46.2998 31.3807 46.7497 32.6201 46.7497C33.8596 46.7497 35.0483 46.2998 35.9248 45.4988L41.9289 39.9692V63.7465C41.9289 64.8746 42.4193 65.9565 43.2922 66.7542C44.1651 67.5519 45.3489 68 46.5834 68C47.8178 68 49.0017 67.5519 49.8745 66.7542C50.7474 65.9565 51.2378 64.8746 51.2378 63.7465V39.9692L57.242 45.4988C57.6746 45.8975 58.1894 46.2139 58.7566 46.4299C59.3238 46.6458 59.9322 46.757 60.5466 46.757C61.161 46.757 61.7694 46.6458 62.3366 46.4299C62.9037 46.2139 63.4185 45.8975 63.8512 45.4988C64.2875 45.1034 64.6337 44.6329 64.87 44.1146C65.1063 43.5963 65.228 43.0403 65.228 42.4788C65.228 41.9173 65.1063 41.3613 64.87 40.843C64.6337 40.3247 64.2875 39.8542 63.8512 39.4588L49.888 26.6982Z"
                                fill="#5E6E82" />
                        </svg>

                        <p class="mb-2 text-sm text-gray-500">
                            <span class="font-semibold">Arraste seu arquivo PDF aqui</span>
                        </p>
                        <p class="text-xs text-gray-500 mb-2">
                            ou <span class="text-gray-600 hover:underline">escolher arquivo</span>
                        </p>
                    </label>

                    <input id="file-upload" wire:model="files" type="file" class="hidden" multiple>

                    <div x-show="isUploading" class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
                        <div class="bg-gray-600 h-2.5 rounded-full" :style="{ width: progress + '%' }"></div>
                    </div>

                    @if ($files)
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-700">Arquivos anexados:</h4>
                            <ul class="list-disc list-inside">
                                @foreach ($files as $file)
                                    <li class="text-sm text-gray-600">{{ $file->getClientOriginalName() }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md mt-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informações</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tipoPeticao" class="block text-sm font-medium text-gray-700">Tipo *</label>
                        <select wire:model="tipoPeticao" id="tipoPeticao"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                            <option value="">Selecione o tipo da petição...</option>
                            <option value="acao_cobranca">Ação de Cobrança</option>
                            <option value="execucao_fiscal">Execução Fiscal</option>
                            <option value="acao_revisional">Ação Revisional</option>
                            <option value="monitoria">Monitória</option>
                        </select>
                        @error('tipoPeticao')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="parteRepresentada" class="block text-sm font-medium text-gray-700">Parte
                            Representada *</label>
                        <select wire:model="parteRepresentada" id="parteRepresentada"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                            <option value="">Selecione a parte representada...</option>
                            <option value="autor">Autor</option>
                            <option value="reu">Réu</option>
                        </select>
                        @error('parteRepresentada')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="instrucoes" class="block text-sm font-medium text-gray-700">Instruções adicionais ou
                            resumo da petição: *</label>
                        <textarea wire:model="instrucoes" id="instrucoes" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"></textarea>
                        @error('instrucoes')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div x-show="$wire.step === 2" x-transition>
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Passo 1 - Jurisprudência</h2>
                <div class="prose prose-sm max-w-none text-gray-700 space-y-4">
                    {!! $jurisprudencia !!}
                </div>
            </div>
        </div>

        <div x-show="$wire.step === 3" x-transition>
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Passo 2 - Escritor</h2>
                <x-forms.trix-editor id="texto_escritor" wire:model="textoEscritor" />
            </div>
        </div>

        <div x-show="$wire.step === 4" x-transition>
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Passo 3 - Revisor Jurídico</h2>
                <x-forms.trix-editor id="texto_revisor" wire:model="textoRevisor" />
            </div>
        </div>

        <div x-show="$wire.step === 5" x-transition>
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Passo 4 - Revisor Ortográfico</h2>
                <x-forms.trix-editor id="texto_final" wire:model="textoFinal" />
            </div>
        </div>

    </div>

    <div class="mt-6 pt-6 border-t border-gray-200 flex justify-between items-center">
        <div>
            <button wire:click="resetProcess" x-show="$wire.step > 1"
                class="text-sm font-medium text-gray-700 hover:text-gray-600">
                Gerar novamente
            </button>
        </div>

        <div>
            <button wire:click="submitForm" wire:loading.attr="disabled" x-show="$wire.step === 1"
                class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-50">
                <span wire:loading.remove wire:target="submitForm">Gerar</span>
                <span wire:loading wire:target="submitForm">Gerando...</span>
            </button>

            <button wire:click="nextStep" x-show="$wire.step > 1 && $wire.step < 5"
                class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Próxima etapa
            </button>

            <button wire:click="resetProcess" x-show="$wire.step === 5"
                class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Concluir
            </button>
        </div>
    </div>

</div>
