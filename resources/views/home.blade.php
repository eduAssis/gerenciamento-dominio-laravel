<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Eduardo de Assis. Entrevista técnica.</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen">

    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Entrevista Técnica</h1>
            <nav>
                <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500 mr-4">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Registrar</a>
            </nav>
        </div>
    </header>

    <main class="flex items-center justify-center min-h-[80vh]">
        <section class="max-w-4xl text-center">
            <h2 class="text-4xl font-bold mb-4">Bem-vindo</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Este sistema foi desenvolvido para uma entrevista técnica e visa o gerenciamento de usuários e domínios.
                Através dele, é possível criar, editar e excluir registros de usuários, além de gerenciar
                informações sobre domínios, servidores e vencimentos.
                <br><br>
                Tecnologias utilizadas:
                <ul class="text-sm text-gray-600 dark:text-gray-300">
                    <li><strong>PHP</strong> 8.x</li>
                    <li><strong>Laravel</strong> 11.x</li>
                    <li><strong>Laravel Breeze</strong> para autenticação e UI</li>
                    <li><strong>Flowbite</strong> para UI com Tailwind CSS</li>
                </ul>
            </p>
            <div class="m-6">
                <a href="{{ route('login') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-lg mr-4">Entrar</a>
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-lg">Criar Conta</a>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>
