<nav x-data="{ open: false }" class="py-2 dark:bg-gray-800 border-b border-gray-800 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 text-sm font-light tracking-wide text-gray-400">

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
                            <div class="dropdown relative">
                                <a class="text-white opacity-60 hover:opacity-80 focus:opacity-80 mr-4 dropdown-toggle hidden-arrow flex items-center"
                                    href="#" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                    </svg>
                                    <span class="text-white bg-red-500 absolute rounded-full text-md font-medium -mt-4 ml-4 py-0 px-1.5">
                                        {{auth()->user()->unreadNotifications->count()}}
                                    </span>
                                </a>
                                <ul class="dropdown-menu min-w-max absolute hidden bg-gray-700 text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none left-auto right-0"
                                aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <livewire:notification-proposal>
                                    </li>
                                </ul>
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
                        <div class="dropdown relative">
                            <a class="dropdown-toggle flex items-center hidden-arrow"
                                href="#" id="dropdownMenuButton2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> 
                                        <path d="M16.5 22.5H18.75C19.1478 22.5 19.5294 22.342 19.8107 22.0607C20.092 21.7794 20.25 21.3978 20.25 21V13.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                                        <path d="M7.5 22.5H5.25C4.85218 22.5 4.47064 22.342 4.18934 22.0607C3.90804 21.7794 3.75 21.3978 3.75 21V13.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                                        <path d="M0.75 12.129L10.939 1.939C11.0783 1.79961 11.2437 1.68904 11.4258 1.61359C11.6078 1.53815 11.8029 1.49932 12 1.49932C12.1971 1.49932 12.3922 1.53815 12.5742 1.61359C12.7563 1.68904 12.9217 1.79961 13.061 1.939L23.122 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                                        <path d="M12 12C13.2426 12 14.25 10.9926 14.25 9.75C14.25 8.50736 13.2426 7.5 12 7.5C10.7574 7.5 9.75 8.50736 9.75 9.75C9.75 10.9926 10.7574 12 12 12Z" stroke="gray" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                                        <path d="M12 13.5C11.0054 13.5 10.0516 13.8951 9.34835 14.5983C8.64509 15.3016 8.25 16.2554 8.25 17.25V18H9.75L10.5 22.5H13.5L14.25 18H15.75V17.25C15.75 16.2554 15.3549 15.3016 14.6517 14.5983C13.9484 13.8951 12.9946 13.5 12 13.5Z" stroke="gray" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g>
                                </svg>                    
                            </a>
                            <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none left-auto right-0"
                                aria-labelledby="dropdownMenuButton2">
                                <li>
                                    <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    href="{{ route('login') }}">Se connecter
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    href="{{ route('register') }}">S'inscrire
                                    </a>
                                </li>
                            </ul>
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
                            <div class="dropdown relative">
                                <a class="text-white opacity-60 hover:opacity-80 focus:opacity-80 mr-4 dropdown-toggle hidden-arrow flex items-center"
                                    href="#" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                    </svg>
                                    <span class="text-white bg-red-500 absolute rounded-full text-md font-medium -mt-4 ml-4 py-0 px-1.5">
                                        {{auth()->user()->unreadNotifications->count()}}
                                    </span>
                                </a>
                                <ul class="dropdown-menu min-w-max absolute hidden bg-gray-700 text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none left-auto right-0"
                                aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <livewire:notification-proposal>
                                    </li>
                                </ul>
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






 
 
