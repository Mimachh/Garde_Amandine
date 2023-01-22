
<div class="min-h-screen bg-white">
  <div>
    <!--
      Mobile filter dialog

      Off-canvas filters for mobile, show/hide based on off-canvas filters state.
    -->
    <div x-cloak x-data="{ open: false }" class="relative z-40 md:hidden" role="dialog" aria-modal="true">
      <!--
        Off-canvas menu backdrop, show/hide based on off-canvas menu state.

        Entering: "transition-opacity ease-linear duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "transition-opacity ease-linear duration-300"
          From: "opacity-100"
          To: "opacity-0"
      -->
      <div x-show="open" id="opacityDiv"  class="fixed inset-0 bg-black bg-opacity-25"></div>

      <div x-show="open" id="filterDiv"  class="fixed inset-0 z-40 flex">
        <!--
          Off-canvas menu, show/hide based on off-canvas menu state.

          Entering: "transition ease-in-out duration-300 transform"
            From: "translate-x-full"
            To: "translate-x-0"
          Leaving: "transition ease-in-out duration-300 transform"
            From: "translate-x-0"
            To: "translate-x-full"
        -->
        <div class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
          <div class="flex items-center justify-between px-4">
            <h2 class="text-lg font-medium text-gray-900">Filtrer</h2>
            <button value="Close Div" onclick="closeDiv()" type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400">
              <span class="sr-only">Close menu</span>
              <!-- Heroicon name: outline/x-mark -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Filters -->
          <form action="{{ route('annonces.search') }}" class="mt-4 border-t border-gray-200">
            <!-- Ville Mobile -->
            <div class="px-4 py-6">
              <h3 class="my-4 flow-root font-medium text-gray-900">Ville de recherche</h3>
              <div class="">
                  <input class="w-full border-none bg-gray-200 rounded-xl" placeholder="Ville de recherche" name="ville" type="search" id="ville">
              </div>
            </div>
            <!-- Type Garde Mobile -->
            <div class="border-t border-gray-200 px-4 py-6">
              <h3 class="-mx-2 -my-3 flow-root">
                <!-- Expand/collapse section button -->
                <button type="button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500" aria-controls="filter-section-mobile-1" aria-expanded="false">
                  <span class="font-medium text-gray-900">Type de garde</span>
                </button>
              </h3>
              <!-- Filter section, show/hide based on section state. -->
              <div class="pt-6" id="filter-section-mobile-1">
                <div class="space-y-4">
                  <div>
                    <select class="border-none bg-gray-200 rounded-xl w-full" name="garde" id="garde">
                        <option value="">Choisir un type de garde</option>
                        @foreach($gardes as $garde)
                        <option value="{{$garde->id }}">{{ $garde->garde }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
             <!-- Animaux Mobile  -->
            <div x-data="{ open: false }"  class="border-t border-gray-200 px-4 py-6">
              <h3 class="-mx-2 -my-3 flow-root">
                <!-- Expand/collapse section button -->
                <button x-on:click="open = ! open" type="button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500" aria-controls="filter-section-mobile-2" aria-expanded="false">
                  <span class="font-medium text-gray-900">Animaux à garder</span>
                  <span class="ml-6 flex items-center">
                    <!--
                      Expand icon, show/hide based on section open state.

                      Heroicon name: mini/plus
                    -->
                    <svg x-show="!open" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    <!--
                      Collapse icon, show/hide based on section open state.

                      Heroicon name: mini/minus
                    -->
                    <svg x-show="open" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" />
                    </svg>
                  </span>
                </button>
              </h3>
              <!-- Filter section, show/hide based on section state. -->
              <div x-cloak x-show="open" x-transition class="pt-6" id="filter-section-mobile-2">
                <div class="space-y-4">
                  <div class="flex items-center">
                    <input id="chats" name="chats" value="1" id="chats" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="chats" class="ml-3 text-sm text-gray-600">Chat</label>
                  </div>

                  <div class="flex items-center">
                    <input name="chiens" value="2" id="chiens" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="chiens" class="ml-3 text-sm text-gray-600">Chien</label>
                  </div>

                  <div class="flex items-center">
                    <input name="poissons" value="3" id="poissons" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="poissons" class="ml-3 text-sm text-gray-600">Poisson</label>
                  </div>

                  <div class="flex items-center">
                    <input name="rongeurs" value="4" id="rongeurs" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="rongeurs" class="ml-3 text-sm text-gray-600">Rongeur</label>
                  </div>

                  <div class="flex items-center">
                    <input name="oiseaux" value="5" id="oiseaux" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="oiseaux" class="ml-3 text-sm text-gray-600">Oiseau</label>
                  </div>

                  <div class="flex items-center">
                    <input name="reptiles" value="6" id="reptiles" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="reptiles" class="ml-3 text-sm text-gray-600">Reptile</label>
                  </div>

                  <div class="flex items-center">
                    <input name="ferme" value="7" id="ferme" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="ferme" class="ml-3 text-sm text-gray-600">Animaux de la ferme</label>
                  </div>

                  <div class="flex items-center">
                    <input name="autre" value="8" id="autre" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="autre" class="ml-3 text-sm text-gray-600">Autre</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-6">
              <!-- Button Mobile -->
              <div class="pt-6" id="filter-section-mobile-0">
                <div class="space-y-6">
                  <button type="submit" class="button-perso inline-block md:px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md
                          hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 
                          active:shadow-lg transition duration-150 ease-in-out w-64 mb-3">
                      <a class="py-2 px-4">Lancer la recherche</a> 
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900">Liste des annonces</h1>

        <div @click.away="open = false" x-data="{ open: false }" class="flex items-center">
          <div class="relative inline-block text-left">
            <div>
              <button x-on:click="open = ! open" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" id="menu-button" aria-expanded="false" aria-haspopup="true">
                Trier par
                <!-- Heroicon name: mini/chevron-down -->
                <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>

            <!--
              Dropdown menu, show/hide based on menu state.

              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
            <div x-cloak x-show="open" x-transition class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
              <div class="py-1" role="none">
                <!--
                  Active: "bg-gray-100", Not Active: ""

                  Selected: "font-medium text-gray-900", Not Selected: "text-gray-500"
                -->
                <a class="text-gray-500 block px-4 py-2 text-sm" href="" role="menuitem" tabindex="-1" id="menu-item-1">
                    Prix Croissant
                </a>
                <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">
                    Prix décroissant                
                </a>

                <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-3">
                    Nombre de like croissant
                </a>

                <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-4">
                    Nombre de like décroissant
                </a>
              </div>
            </div>
          </div>

          <button type="button" class="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7">
            <span class="sr-only">View grid</span>
            <!-- Heroicon name: mini/squares-2x2 -->
            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z" clip-rule="evenodd" />
            </svg>
          </button>
          <button value="Show Div" onclick="showDiv()"  type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden">
            <span class="sr-only">Filters</span>
            <!-- Heroicon name: mini/funnel -->
            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>

      <section aria-labelledby="products-heading" class="pt-6 pb-24">
        <h2 id="products-heading" class="sr-only">Products</h2>

        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
          <!-- Filters -->
          <form action="{{ route('annonces.search') }}" class="hidden lg:block">
            <h3 class="py-6">
                <span class="font-medium text-gray-900">Ville de recherche</span>
            </h3>
            <div>
                <input value="{{ request()->ville ?? '' }}" class="border-none bg-gray-200 rounded-xl w-full" placeholder="Ville de recherche" name="ville" type="search" id="ville">
            </div>

            <div class="border-b border-gray-200 py-6">
              <h3 class="-my-3 flow-root">
                <!-- Expand/collapse section button -->
                <button type="button" class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500" aria-controls="filter-section-1" aria-expanded="false">
                  <span class="font-medium text-gray-900">Type de garde</span>
                  <span class="ml-6 flex items-center">
                    <!--
                      Expand icon, show/hide based on section open state.

                      Heroicon name: mini/plus
                    -->
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    <!--
                      Collapse icon, show/hide based on section open state.

                      Heroicon name: mini/minus
                    -->
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" />
                    </svg>
                  </span>
                </button>
              </h3>
              <!-- Filter section, show/hide based on section state. -->
              <div class="pt-6" id="filter-section-1">
                <div class="space-y-4">
                  <div>
                    @if(request()->garde)
                    <select  class="border-none bg-gray-200 rounded-xl w-full" name="garde" id="garde">
                        <option value="{{ request()->garde ?? '' }}">
                          @if(request()->garde == 1) Chez le Pet-Sitter
                          @elseif(request()->garde == 2) Visite à domicile
                          @elseif(request()->garde == 3) Chez le Pet-Sitter/En visite
                          @endif
                        </option>
                        @foreach($gardes as $garde)
                        <option value="{{$garde->id }}">{{$garde->garde }}</option>
                        @endforeach
                    </select>
                    @else
                    <select  class="border-none bg-gray-200 rounded-xl w-full" name="garde" id="garde">
                        <option value="">Choisir un type de garde</option>
                        @foreach($gardes as $garde)
                        <option value="{{$garde->id }}">{{$garde->garde }}</option>
                        @endforeach
                    </select>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div x-data="{ open: false }" class="border-b border-gray-200 py-6">
              <h3 class="-my-3 flow-root">
                <!-- Expand/collapse section button -->
                <button x-on:click="open = ! open" type="button" class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500" aria-controls="filter-section-0" aria-expanded="false">
                  <span class="font-medium text-gray-900">Animal/aux à garder </span>
                  <span class="ml-6 flex items-center">
                    <!--
                      Expand icon, show/hide based on section open state.

                      Heroicon name: mini/plus
                    -->
                    <svg x-show="!open" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    <!--
                      Collapse icon, show/hide based on section open state.

                      Heroicon name: mini/minus
                    -->
                    <svg x-show="open" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" />
                    </svg>
                  </span>
                </button>
              </h3>
              <!-- Filter section, show/hide based on section state. -->
              <div x-cloak x-show="open" x-transition class="pt-6" id="filter-section-0">
                <div class="space-y-4">
                  <div class="flex items-center">
                    <input id="chats" name="chats" value="1" id="chats" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->chats) {{ 'checked' }} @endif>
                    <label for="chats" class="ml-3 text-sm text-gray-600">Chat</label>
                  </div>

                  <div class="flex items-center">
                    <input name="chiens" value="2" id="chiens" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->chiens) {{ 'checked' }} @endif>
                    <label for="chiens" class="ml-3 text-sm text-gray-600">Chien</label>
                  </div>

                  <div class="flex items-center">
                    <input name="poissons" value="3" id="poissons" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->poissons) {{ 'checked' }} @endif>
                    <label for="poissons" class="ml-3 text-sm text-gray-600">Poisson</label>
                  </div>

                  <div class="flex items-center">
                    <input name="rongeurs" value="4" id="rongeurs" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->rongeurs) {{ 'checked' }} @endif>
                    <label for="rongeurs" class="ml-3 text-sm text-gray-600">Rongeur</label>
                  </div>

                  <div class="flex items-center">
                    <input name="oiseaux" value="5" id="oiseaux" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->oiseaux) {{ 'checked' }} @endif>
                    <label for="oiseaux" class="ml-3 text-sm text-gray-600">Oiseau</label>
                  </div>

                  <div class="flex items-center">
                    <input name="reptiles" value="6" id="reptiles" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->reptiles) {{ 'checked' }} @endif>
                    <label for="reptiles" class="ml-3 text-sm text-gray-600">Reptile</label>
                  </div>

                  <div class="flex items-center">
                    <input name="ferme" value="7" id="ferme" type="checkbox" 
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->ferme) {{ 'checked' }} @endif>
                    <label for="ferme" class="ml-3 text-sm text-gray-600">Animaux de la ferme</label>
                  </div>

                  <div class="flex items-center">
                    <input name="autre" value="8" id="autre" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @if(request()->autre) {{ 'checked' }} @endif>
                    <label for="autre" class="ml-3 text-sm text-gray-600">Autre</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="border-b border-gray-200 py-6">
              <!-- Filter section, show/hide based on section state. -->
              <div class="pt-6" id="filter-section-1">
                <button type="submit" class="button-perso inline-block md:px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md
                        hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 
                        active:shadow-lg transition duration-150 ease-in-out w-64 mb-3">
                    <a class="py-2 px-4">Lancer la recherche</a> 
                </button>
              </div>
            </div>
          </form>

          <!-- Product grid -->
          <div class="lg:col-span-3">
            <!-- Replace with your content -->
            <div class="h-96 rounded-lg border-4 border-dashed border-blue-200 lg:h-full">
                Ici
            </div>
            <!-- /End replace -->
          </div>
        </div>
      </section>
    </main>
  </div>
  <script>
    function showDiv() {
   document.getElementById('filterDiv').style.display = "flex";
   document.getElementById('opacityDiv').style.display = "block";
}
function closeDiv() {
   document.getElementById('filterDiv').style.display = "none";
   document.getElementById('opacityDiv').style.display = "none";
}
</script>
</div>


