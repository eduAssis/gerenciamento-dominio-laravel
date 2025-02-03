<x-app-layout>
    <x-slot name="header">
        <x-heading-page> Gerenciar Domínios </x-heading-page>
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
                <form method="GET" action="{{ route('domains.index') }}" class="flex flex-col gap-4">

                    <x-input-field type="search" name="search" label="" placeholder="Faça sua busca"
                                   value="{{ request('search') }}"/>

                    <div class="flex flex-wrap gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="sort_by">Ordenar por:</label>
                            <select name="sort_by"
                                    class="border rounded-lg dark:bg-gray-700 dark:text-white"
                                    onchange="this.form.submit()"
                            >
                                <option value="domain" {{ request('sort_by') == 'domain' ? 'selected' : '' }}>
                                    Domínio
                                </option>
                                <option value="owner" {{ request('sort_by') == 'owner' ? 'selected' : '' }}>
                                    Proprietário
                                </option>
                                <option value="expires_date" {{ request('sort_by') == 'expires_date' ? 'selected' : '' }}>
                                    Vencimento
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
                                $dispatch('open-modal', 'domain-modal');
                                document.getElementById('domain-form').action = '{{ route('domains.store') }}';
                                document.getElementById('_method_domain_form').value = 'POST';
                                document.getElementById('form-title').textContent = 'Adicionar Domínio';
                                document.getElementById('domain').value = '';
                                document.getElementById('owner').value = '';
                                document.getElementById('owner_email').value = '';
                                document.getElementById('nserver1').value = '';
                                document.getElementById('expires_date').value = '';
                            ">
                        + Adicionar Domínio
                    </x-primary-button>
                </div>
                <div id="accordion-collapse" data-accordion="collapse">
                    @foreach($domains as $loopDomain)
                        <h2 id="accordion-heading-{{ $loopDomain->id }}">
                            <x-accordion-button :targetId="'accordion-body-' . $loopDomain->id">
                                {{ $loopDomain->domain }}
                            </x-accordion-button>
                        </h2>
                        <div id="accordion-body-{{ $loopDomain->id }}" class="hidden"
                             aria-labelledby="accordion-heading-{{ $loopDomain->id }}">
                            <div class="p-4 border border-b-0 border-gray-200 dark:border-gray-700">
                                <p><strong>Domínio:</strong> {{ $loopDomain->domain }}</p>
                                <p><strong>Proprietário:</strong> {{ $loopDomain->owner }}</p>
                                <p><strong>Email:</strong> {{ $loopDomain->owner_email }}</p>
                                <p><strong>DNS Servidor Principal:</strong> {{ $loopDomain->nserver }}</p>
                                <p><strong>Vencimento:</strong> {{ $loopDomain->expires_date }}</p>

                                <div class="flex space-x-2 mt-4">
                                    <x-primary-button
                                            x-data="{}"
                                            x-on:click.prevent="
                                                $dispatch('open-modal', 'domain-modal');
                                                document.getElementById('domain-form').action = '{{ route('domains.update', $loopDomain->id) }}';
                                                document.getElementById('_method_domain_form').value = 'PUT';
                                                document.getElementById('form-title').textContent = 'Editar Domínio {{ $loopDomain->domain }}';
                                                document.getElementById('domain').value = '{{ $loopDomain->domain }}';
                                                document.getElementById('owner').value = '{{ $loopDomain->owner }}';
                                                document.getElementById('owner_email').value = '{{ $loopDomain->owner_email }}';
                                                document.getElementById('nserver').value = '{{ $loopDomain->nserver }}';
                                                document.getElementById('expires_date').value = '{{ $loopDomain->expires_date }}';
                                            ">
                                        Atualizar
                                    </x-primary-button>
                                    <x-danger-button
                                            x-data=""
                                            x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-domain-deletion');
                                        document.getElementById('delete-form').action = '{{ route('domains.destroy', $loopDomain->id) }}';
                                    ">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                    <x-secondary-button
                                            x-data=""
                                            x-on:click.prevent="window.location.href = '{{ route('whois.search') }}?search=' + encodeURIComponent('{{ $loopDomain->domain }}')">
                                        Buscar Whois
                                    </x-secondary-button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4 px-4 py-3 bg-white dark:bg-gray-800 sm:rounded-lg">
                        {{ $domains->appends([
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

    @include('partials.modal-create-domains')
    @include('partials.modal-delete-domains')

</x-app-layout>