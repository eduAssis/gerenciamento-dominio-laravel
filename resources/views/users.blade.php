<x-app-layout>
    <x-slot name="header">
        <x-heading-page> Gerenciar Usuários </x-heading-page>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <x-alert-success> {{ session('success') }} </x-alert-success>
            @endif
            @if(session('error'))
                <x-alert-error> {{ session('error') }} </x-alert-error>
            @endif

            <div class="mb-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <form method="GET" action="{{ route('users.index') }}" class="flex flex-col gap-4">

                    <x-input-field type="text" name="search" label="" placeholder="Digite nome ou e-mail"
                            value="{{ request('search') }}"/>

                    <div class="flex flex-wrap gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="sort_by">Ordenar por:</label>
                            <select name="sort_by"
                                    class="border rounded-lg dark:bg-gray-700 dark:text-white"
                                    onchange="this.form.submit()"
                            >
                                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>
                                    Nome
                                </option>
                                <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>
                                    E-mail
                                </option>
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                    Data de Criação
                                </option>
                            </select>
                            <select name="sort_dir"
                                    class="border rounded-lg dark:bg-gray-700 dark:text-white"
                                    onchange="this.form.submit()"
                            >
                                <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>
                                    Ascendente
                                </option>
                                <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>
                                    Descendente
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex space-x-2 my-4">
                    <x-primary-button
                            x-data=""
                            x-on:click.prevent="
                                $dispatch('open-modal', 'user-modal');
                                document.getElementById('user-form').action = '{{ route('users.store') }}';
                                document.getElementById('_method_user_form').value = 'POST';
                                document.getElementById('form-title').textContent = 'Adicionar Usuário';
                                document.getElementById('name').value = '';
                                document.getElementById('email').value = '';
                                document.getElementById('password').value = '';
                                document.getElementById('password_confirmation').value = '';
                            ">
                        + Adicionar Usuário
                    </x-primary-button>
                </div>

                <div id="accordion-collapse" data-accordion="collapse">
                    @foreach($users as $loopUser)
                        <h2 id="accordion-heading-{{ $loopUser->id }}">
                            <x-accordion-button :targetId="'accordion-body-' . $loopUser->id">
                                {{ $loopUser->name }}
                            </x-accordion-button>
                        </h2>
                        <div id="accordion-body-{{ $loopUser->id }}" class="hidden"
                             aria-labelledby="accordion-heading-{{ $loopUser->id }}">
                            <div class="p-4 border border-b-0 border-gray-200 dark:border-gray-700">
                                <p><strong>Nome:</strong> {{ $loopUser->name }}</p>
                                <p><strong>Email:</strong> {{ $loopUser->email }}</p>

                                <div class="flex space-x-2 mt-4">
                                    <x-primary-button
                                            x-data="{}"
                                            x-on:click.prevent="
                                                $dispatch('open-modal', 'user-modal');
                                                document.getElementById('user-form').action = '{{ route('users.update', $loopUser->id) }}';
                                                document.getElementById('_method_user_form').value = 'PUT';
                                                document.getElementById('form-title').textContent = 'Editar Usuário {{ $loopUser->name }}';
                                                document.getElementById('name').value = '{{ $loopUser->name }}';
                                                document.getElementById('email').value = '{{ $loopUser->email }}';
                                                document.getElementById('password').value = '';
                                                document.getElementById('password_confirmation').value = '';
                                    ">
                                        Atualizar
                                    </x-primary-button>
                                    <x-danger-button
                                            x-data=""
                                            x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-user-deletion');
                                        document.getElementById('delete-form').action = '{{ route('users.destroy', $loopUser->id) }}';
                                    ">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4 px-4 py-3 bg-white dark:bg-gray-800 sm:rounded-lg">
                        {{ $users->appends([
                                'search' => request('search'),
                                'sort_by' => request('sort_by'),
                                'sort_dir' => request('sort_dir')
                            ])->links()
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modal-create-users')
    @include('partials.modal-delete-users')

</x-app-layout>