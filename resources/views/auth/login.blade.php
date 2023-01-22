<x-app-layout>
    <section class="mb-4 flex flex-col lg:flex-row min-h-screen items-center container md:mx-auto">

        <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <img src="https://source.unsplash.com/random" alt="" class="w-full h-full object-cover">
        </div>

        <div class="w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
                flex items-center justify-center">

            <div class="w-full h-100">


            <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Connexion</h1>
                <x-jet-validation-errors class="mb-4" />

            <form class="mt-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-jet-label for="email" value="{{ __('Adresse mail') }}" />
                    <x-jet-input id="email" placeholder="Votre Adresse Mail" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                    type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Mot de passe') }}" />
                    <x-jet-input id="password" placeholder="Mot de passe" minlength="8" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                        focus:bg-white focus:outline-none" type="password" name="password" required autocomplete="current-password" />    
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-right mt-2">
                        <a href="{{ route('password.request') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">Mot de passe oublié?</a>
                    </div>
                @endif

                <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg
                    px-4 py-3 mt-6">Se connecter
                </button>

            </form>

            <hr class="my-6 border-gray-300 w-full">

            <button type="button" class="w-full block bg-white hover:bg-gray-100 focus:bg-gray-100 text-gray-900 font-semibold rounded-lg px-4 py-3 border border-gray-300">
                    <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                    <span class="ml-4">
                    Log in
                    with
                    Google</span>
                    </div>
                </button>

            <p class="mt-8">Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 font-semibold">Créer un compte</a>
            </p>


            </div>
        </div>

    </section>
</x-app-layout>
