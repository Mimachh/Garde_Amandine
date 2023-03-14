<nav x-data="{ open: false }" class="py-2 dark:bg-gray-800 border-b border-gray-800 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 text-sm font-light tracking-wide text-white">

            <!-- Navbar pour tous -->
            <div class="flex space-x-10">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                @auth
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" style="color: #cbd5e0">
                        {{ __('Tableau de bord') }}
                    </x-jet-nav-link>
                </div>
                @endauth

                @auth
                    @if(auth()->user()->role->name === 'Admin')
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
                            <x-jet-nav-link href="{{ route('admin/') }}" :active="request()->routeIs('admin/')" style="color: #cbd5e0">
                                {{ __('Tableau Admin') }}
                            </x-jet-nav-link>
                        </div>
                    @endif
                @endauth

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('annonces.index') }}" :active="request()->routeIs('annonces.index')" style="color: #cbd5e0">
                        {{ __('Voir les annonces') }}
                    </x-jet-nav-link>   
                </div>
                
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link class="rounded-full px-2 h-12 mt-2 " href="{{ route('annonces.create') }}" :active="request()->routeIs('annonces.create')" style="color: #cbd5e0; background-color: #1D4ED8;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ __('Ajouter une annonce') }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('annonces.create') }}" :active="request()->routeIs('annonces.create')" style="color: #cbd5e0">
                        {{ __('Articles') }}
                    </x-jet-nav-link>
                </div>


            </div>


            <div class="hidden sm:flex sm:items-center sm:ml-6" >

                
                <!-- Navbar lorsque connecté -->
                

                <!-- Notifications -->
                    @auth
                        @if(auth()->user()->unreadNotifications->count() > 0)

                        <div class="ml-4 relative">
                            <x-jet-dropdown align="right" width="48" >
                                <x-slot name="trigger" >
                                    <button class="relative opacity-70">
                                        <div class="flex items-center">
                                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                        </svg>
                                        <span class="text-white bg-red-500 absolute rounded-full text-md font-medium -mt-4 ml-4 py-0 px-1.5">
                                            {{auth()->user()->unreadNotifications->count()}}
                                        </span>
                                        </div> 
                                    </button> 
                                </x-slot>
                                <x-slot name="content">
                                    <livewire:notification-proposal>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                           
                        @endif
                    @endauth
                <!-- Fin notifications -->

                 <!-- MENU DEROULANT CONNECTE -->
                 <div class="hidden top-0 right-0 px-6 py-4 sm:block" >
                    @auth 
                    <div class="ml-4 relative">
                        
                        <x-jet-dropdown align="right" width="48" >
                            
                            <x-slot name="trigger" >
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" style="color: #cbd5e0">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400" style="color: #cbd5e0">
                                    {{ __('Paramètres de mon compte') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}" style="color: #cbd5e0">
                                    {{ __('Gérer mon Profil') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                            
                                
                                <x-jet-dropdown-link href="{{ route('dashboard') }}" style="color: #cbd5e0">
                                    {{ __('Mon tableau de bord') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('proposals.index') }}" style="color: #cbd5e0">
                                    {{ __('Mes gardes') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}" style="color: #cbd5e0">
                                    {{ __('Ma messagerie') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-600"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();" style="color: #cbd5e0">
                                        {{ __('Me déconnecter') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                        
                    </div>
                    @endauth  
               
                    @guest
                        @if (Route::has('register'))
                        <div class="space-x-2 font-medium">
                            <a href="{{ route('login') }}">Se connecter</a>
                            <a href="{{ route('register') }}">S'inscrire</a>
                        </div>    
                        @endif
                    @endguest
                </div>
                <!-- / MENU DEROULANT CONNECTE -->
            
                
                
            </div>

            <div class="-mr-2 flex items-center sm:hidden" >
                <!-- Notifications -->
                    @auth
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <div class="ml-4 relative">
                            <x-jet-dropdown align="right" width="48" >
                                <x-slot name="trigger" >
                                    <button class="relative opacity-70">
                                        <div class="flex items-center">
                                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                        </svg>
                                        <span class="text-white bg-red-500 absolute rounded-full text-md font-medium -mt-4 ml-4 py-0 px-1.5">
                                            {{auth()->user()->unreadNotifications->count()}}
                                        </span>
                                        </div> 
                                    </button> 
                                </x-slot>
                                <x-slot name="content">
                                    <livewire:notification-proposal>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                        @endif
                    @endauth
                <!-- Fin notifications -->
                <button @click="open = ! open" class=" ml-4 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        
            @auth 
            <!-- Navbar responsive bouton lorsque connecté -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden ">
        
           
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex px-4 justify-end">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif      
                    </div>
                    

                    <div class="mt-3 space-y-1 text-end">
                        <x-jet-responsive-nav-link href="{{ route('annonces.index') }}" :active="request()->routeIs('annonces.index')">
                                {{ __('Voir les annonces') }}
                        </x-jet-responsive-nav-link>
                        
                        <x-jet-nav-link class="rounded-full px-2 h-12 my-2" href="{{ route('annonces.create') }}" :active="request()->routeIs('annonces.create')" style="color: #cbd5e0; background-color: #1D4ED8;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            {{ __('Ajouter une annonce') }}
                        </x-jet-nav-link>

                        @if(auth()->user()->role->name === 'Admin')
                                <x-jet-responsive-nav-link href="{{ route('admin/') }}" :active="request()->routeIs('admin/')">
                                    {{ __('Tableau Admin') }}
                                </x-jet-responsive-nav-link>
                        @endif
                
                        <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                {{ __('Mon tableau de bord') }}
                        </x-jet-responsive-nav-link>


                        <x-jet-responsive-nav-link href="{{ route('annonces.create') }}" :active="request()->routeIs('annonces.create')">
                                {{ __('Articles') }}
                        </x-jet-responsive-nav-link>

                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Mon profil') }}
                        </x-jet-responsive-nav-link>


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                {{ __('Se déconnecter') }}
                            </x-jet-responsive-nav-link>
                        </form>             
                    </div>
                </div>
            </div>
            @endauth
        @guest

        <!-- Bouton responsive de la navbar lorsque non connecté -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                
                    </div>

                    <div class="mt-3 space-y-1">
                    
                        <x-jet-responsive-nav-link href="{{ route('annonces.index') }}" :active="request()->routeIs('annonces.index')">
                                {{ __('Voir les annonces') }}
                        </x-jet-responsive-nav-link>

                        <x-jet-responsive-nav-link href="{{ route('annonces.create') }}" :active="request()->routeIs('annonces.create')">
                                {{ __('Ajouter une annonce') }}
                        </x-jet-responsive-nav-link>

                        <x-jet-responsive-nav-link href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500">
                            {{ __('Se connecter') }}
                        </x-jet-responsive-nav-link>

                        <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('/register')" class=" text-sm text-gray-700 dark:text-gray-500">
                            {{ __("S'inscrire") }}
                        </x-jet-responsive-nav-link>
                    
                    </div>
                </div>
            </div>
        @endguest

    </div>
        
    
</nav>






 
 
