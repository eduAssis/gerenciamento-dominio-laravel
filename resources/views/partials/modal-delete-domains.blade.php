<x-modal name="confirm-domain-deletion" x-show="open" focusable>
    <form id="delete-form" class="p-6" method="POST">
        @csrf
        @method('DELETE')
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Você tem certeza que deseja deletar esse domínio?
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')"> Cancelar</x-secondary-button>
            <x-danger-button class="ms-3"> Deletar</x-danger-button>
        </div>
    </form>
</x-modal>