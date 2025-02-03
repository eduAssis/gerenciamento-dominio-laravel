<x-modal name="domain-modal" x-show="open" focusable>
    <h2 id="form-title" class="text-lg font-medium text-gray-900 dark:text-gray-100 p-6"></h2>
    <form id="domain-form" class="pb-6 px-6" method="POST">
        @csrf
        <input type="hidden" name="_method" id="_method_domain_form" value="POST">
        <x-input-field type="text" name="domain" id="domain" label="Domain" required/>
        <x-input-field type="text" name="owner" id="owner" label="Proprietário" required/>
        <x-input-field type="email" name="owner_email" id="owner_email" label="E-mail"/>
        <x-input-field type="text" name="nserver" id="nserver" label="Nome Servidor"/>
        <x-input-field type="date" name="expires_date" id="expires_date" label="Vencimento"/>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')"> Cancelar</x-secondary-button>
            <x-primary-button class="ms-3"> Salvar</x-primary-button>
        </div>
    </form>
</x-modal>