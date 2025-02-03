<x-app-layout>
    <x-slot name="header">
        <x-heading-page> Dashboard </x-heading-page>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg max-w-2xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold">Bem-vindo, {{ $userName }}</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Hoje é {{ now()->format('d/m/Y') }}.</p>
                </div>
            </div>

            <livewire:dashboard-stats />

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ url('/log-viewer') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-4 rounded"
                    >
                        Log Viewer
                    </a>
                    <a href="{{ url('/pulse') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mx-4 rounded"
                    >
                        Laravel Pulse
                    </a>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
