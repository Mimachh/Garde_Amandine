<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Styles -->
        @livewireStyles
        <style>
            [x-cloak] { display: none;}
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/css_perso.css'])
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </head>
    <body class="font-tommy antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-perso shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <!-- Messages flash -->     
                    @livewire('flash')
                    @include ('partials.messages')  
                <!-- Fin Messages flash -->
                {{ $slot }}
            </main>
        </div>
        @stack('modals')
    <!-- SCRIPTS -->
        @livewireScripts               
        @auth
            @vite(['resources/js/confirmationModal.js', 'resources/js/app.js'])            
            <script>
                window.User = {
                    id: {{ optional(auth()->user())->id }}
                }
            </script>
        @endauth
    <!-- FIN SCRIPTS -->
    </body>
</html>
