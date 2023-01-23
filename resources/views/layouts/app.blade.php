<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles
        <style>
            [x-cloak] { display: none;}
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/css_perso.css'])
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




        <!-- For test-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </head>
    <body class="font-tommy antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-perso shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Button Back --> 
            @if(isset($buttonBack))    
                <div class="mt-2">
                    {{ $buttonBack}}
                </div>
            @endif
            <!-- Page Content -->
            <main>
                <!-- Messages flash -->     
                    @livewire('flash')
                    @include ('partials.messages')  
                <!-- Fin Messages flash -->

                {{ $slot }}
                @yield('content')      
            </main>
            @livewire('footer')
        </div>
        @stack('modals')
    <!-- SCRIPTS -->
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <!-- <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>                 -->
        @auth
            @vite(['resources/js/confirmationModal.js', 'resources/js/app.js'])            
            <script>
                window.User = {
                    id: {{ optional(auth()->user())->id }}
                }
            </script>
        @endauth
        @guest
            @vite(['resources/js/app.js', 'resources/js/perso.js'])
        @endguest
    <!-- FIN SCRIPTS -->
    </body>
</html>
