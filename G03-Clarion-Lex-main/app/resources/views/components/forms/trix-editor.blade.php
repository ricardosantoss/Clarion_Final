@props(['id', 'value' => ''])

<div
    wire:ignore
    x-data="{
        value: @entangle($attributes->wire('model')),
        instance: null,
        init() {
            const trixElement = this.$refs.trix;

            // 1. ESPERAR PELO EVENTO 'trix-initialize'
            //    Isso garante que o 'trixElement.editor' exista.
            trixElement.addEventListener('trix-initialize', () => {
                // 2. AGORA é seguro definir a instância
                this.instance = trixElement.editor;

                // 3. Carregar o valor inicial (se existir)
                if (this.value) {
                    this.instance.loadHTML(this.value);
                }

                // 4. Adicionar o listener de 'trix-change' para atualizar o Livewire
                trixElement.addEventListener('trix-change', () => {
                    this.value = trixElement.innerHTML;
                });

                // 5. Adicionar o '$watch' para atualizações vindas do backend
                this.$watch('value', (newValue) => {
                    if (newValue !== trixElement.innerHTML) {
                        this.instance.loadHTML(newValue || '');
                    }
                });
            });
        }
    }"
>
    <input id="{{ $id }}" type="hidden" value="{{ $value }}">

    <trix-editor
        x-ref="trix"
        input="{{ $id }}"
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 trix-content"
    ></trix-editor>
</div>

<style>
    .trix-content {
        background-color: white;
        min-height: 300px;
        border-radius: 0.375rem;
        border: 1px solid #D1D5DB;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    }
    .trix-content:focus-within {
        border-color: #6366F1;
        box-shadow: 0 0 0 1px #6366F1;
    }
    .trix-content h1, .trix-content h2, .trix-content h3,
    .trix-content p, .trix-content ol, .trix-content ul,
    .trix-content strong, .trix-content a {
        all: revert;
    }
</style>
