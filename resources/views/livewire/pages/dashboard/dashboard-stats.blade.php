<div wire:poll.1s class="grid grid-cols-1 md:grid-cols-3 gap-6 py-6">
    <div class="bg-blue-500 text-white p-6 rounded-lg shadow min-h-[100px]">
        <h3 class="text-lg font-semibold">Usuários</h3>
        <p class="text-3xl mt-2">{{ $userCount }}</p>
        <p class="text-sm mt-2 text-gray-200">Última atualização: {{ $lastUpdated->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="bg-green-500 text-white p-6 rounded-lg shadow min-h-[100px]">
        <h3 class="text-lg font-semibold">Domínios Cadastrados</h3>
        <p class="text-3xl mt-2">{{ $activeDomains }}</p>
        <p class="text-sm mt-2 text-gray-200">Última atualização: {{ $lastUpdated->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="bg-red-500 text-white p-6 rounded-lg shadow min-h-[100px]">
        <h3 class="text-lg font-semibold">Domínios expirando</h3>
        <p class="text-3xl mt-2">{{ $expiringDomains }}</p>
        <p class="text-sm mt-2 text-gray-200">Última atualização: {{ $lastUpdated->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="bg-gray-700 text-white rounded-lg shadow-md p-2 flex items-center justify-between">
        <p class="text-sm">Atualização a cada 1 segundo com Livewire.</p>
    </div>
</div>