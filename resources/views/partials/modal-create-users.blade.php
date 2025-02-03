<x-modal name="user-modal" x-show="open" focusable>
    <h2 id="form-title" class="text-lg font-medium text-gray-900 dark:text-gray-100 p-6"></h2>
    <form id="user-form" class="pb-6 px-6" method="POST">
        @csrf
        <input type="hidden" name="_method" id="_method_user_form" value="POST">
        <x-input-field type="text" name="name" id="name" label="Nome" required/>
        <x-input-field type="email" name="email" id="email" label="E-mail" required/>
        <x-input-field type="password" name="password" id="password"
                       label="Senha" required/>
        <x-input-field type="password" name="password_confirmation" id="password_confirmation"
                       label="Confirmar Senha" required/>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')"> Cancelar</x-secondary-button>
            <x-primary-button class="ms-3"> Salvar</x-primary-button>
        </div>
    </form>
</x-modal>