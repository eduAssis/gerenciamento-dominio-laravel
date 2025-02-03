<x-app-layout>
    <x-slot name="header">
        <x-heading-page> Busca WHOIS</x-heading-page>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('error'))
                <x-alert-error> {{ session('error') }} </x-alert-error>
            @endif

            <div class="mb-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <form method="GET" action="{{ route('whois.search') }}" class="flex flex-col gap-4">
                    <x-input-field type="search" name="search" label="" placeholder="Faça sua busca"/>
                    <div class="flex space-x-2">
                        <x-primary-button> Buscar</x-primary-button>
                    </div>
                    <div class="text-sm text-gray-500">
                        <p>
                            Requisições restantes:
                            <strong>{{ $remainingRequests ?? ' XXX' }}</strong> / 500
                        </p>
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                        <p>
                            Dados fornecidos por
                            <a href="https://whoisjson.com" target="_blank" class="underline">WhoisJSON.com</a>
                        </p>
                    </div>
                </form>
            </div>

            @if(isset($data))
                <div class="mt-6">
                    <h2 class="text-lg font-semibold">Informações do Domínio: {{ $data['name'] ?? 'Não disponível' }}</h2>

                    @if(!empty($data))
                        <div class="mt-4">
                            <pre class="bg-gray-800 text-white p-2 rounded overflow-x-auto whitespace-pre-wrap">
                                {{ json_encode($data, JSON_PRETTY_PRINT) }}
                            </pre>
                        </div>
                        @if(!session('error'))
                            <div class="my-4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                            @if($domainRecord)
                                <h3 class="mb-4 text-lg font-semibold"><strong> Domínio já cadastrado </strong></h3>
                                <p><strong>Domínio:</strong> {{ $domainRecord->domain }}</p>
                                <p><strong>Proprietário:</strong> {{ $domainRecord->owner }}</p>
                                <p><strong>Email:</strong> {{ $domainRecord->owner_email }}</p>
                                <p><strong>DNS Servidor Principal:</strong> {{ $domainRecord->nserver }}</p>
                                <p><strong>Vencimento:</strong> {{ $domainRecord->expires_date }}</p>
                                <div class="flex space-x-2 mt-4">
                                    <x-primary-button
                                            x-data=""
                                            x-on:click.prevent="
                                            $dispatch('open-modal', 'domain-modal');
                                            document.getElementById('domain-form').action = '{{ route('domains.update', $domainRecord->id) }}';
                                            document.getElementById('_method_domain_form').value = 'PUT';
                                            document.getElementById('form-title').textContent = 'Editar Domínio';
                                            document.getElementById('domain').value = '{{ $data['name'] ?? 'Não disponível' }}';
                                            document.getElementById('owner').value = '{{ $data['registrar']['name'] ?? 'Não disponível' }}';
                                            document.getElementById('owner_email').value = '{{ $data['registrar']['email'] ?? 'Não disponível' }}';
                                            document.getElementById('nserver').value = '{{ $data['nameserver'] ?? 'Não disponível' }}';
                                            document.getElementById('expires_date').value = '{{ $data['expires'] ?? 'Não disponível' }}';
                                        ">
                                        Atualizar Domínio
                                    </x-primary-button>
                                </div>
                            @else
                                <h3 class="mb-4 text-lg font-semibold"><strong> Cadastrar Domínio </strong></h3>
                                <div class="flex space-x-2 mt-4">
                                    <x-primary-button
                                            x-data=""
                                            x-on:click.prevent="
                                            $dispatch('open-modal', 'domain-modal');
                                            document.getElementById('domain-form').action = '{{ route('domains.store') }}';
                                            document.getElementById('_method_domain_form').value = 'POST';
                                            document.getElementById('form-title').textContent = 'Adicionar Domínio';
                                            document.getElementById('domain').value = '{{ $data['nameserver'] ?? 'Não disponível' }}';
                                            document.getElementById('owner').value = '{{ $data['registrar']['name'] ?? 'Não disponível' }}';
                                            document.getElementById('owner_email').value = '{{ $data['registrar']['email'] ?? 'Não disponível' }}';
                                            document.getElementById('nserver').value = '{{ $data['nameserver'] ?? 'Não disponível' }}';
                                            document.getElementById('expires_date').value = '{{ $data['expires'] ?? 'Não disponível' }}';
                                        ">
                                        + Salvar Domínio
                                    </x-primary-button>
                                </div>
                            @endif
                        </div>
                        @endif
                    @else
                        <p class="text-red-500 mt-4">Nenhuma informação encontrada para o domínio.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @include('partials.modal-create-domains')
</x-app-layout>