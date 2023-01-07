<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/css_perso.css'])
       

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Pour les flash messages -->
        <style>
            [x-cloak] { display: none;}
        </style>

        <!-- Styles -->
        @livewireStyles

    </head>
    <body class="font-sans antialiased">
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
        <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
        <!-- Sweet Alert 2 Confirmation Delete Annonce -->
            <script>
                window.addEventListener('show-delete-confirmation', event => {
                    Swal.fire({
                        title: 'Supprimer cette annonce ?',
                        text: "Cette action est irreversible !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Non',
                        confirmButtonText: 'Confirmer !'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.emit('deleteConfirmed')
                            }
                    })
                });
                
            </script>
        <!-- Fin Sweet Alert 2 Confirmation Delete Annonce -->
        
        <!-- Sweet Alert 2 Confirmation Delete Animal -->
            <script>
                window.addEventListener('show-delete-confirmation-animal', event => {
                    Swal.fire({
                        title: 'Supprimer cette fiche ?',
                        text: "Cette action est irreversible !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Non',
                        confirmButtonText: 'Confirmer !'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.emit('deleteAnimalConfirmed')
                            }
                    })
                });
                
            </script>
        <!-- Fin Sweet Alert 2 Confirmation Delete Animal-->

        
        @auth
            <script src="{{ asset('js/app.js') }}" defer></script>
            <script>
                window.User = {
                    id: {{ optional(auth()->user())->id }}
                }
            </script>
        @endauth

        <!-- Script de secours pour les non connecté, import d'alpine -->
            <script src="{{ asset('js/perso.js') }}" defer></script>
        <!-- Fin script de secours pour les non connecté, import d'alpine -->

            <script src="{{ asset('js/app_perso.js') }}" defer></script>

            @vite(['resources/js/app.js', 'resources/js/perso.js'])
    <!-- FIN SCRIPTS -->
    </body>
</html>
