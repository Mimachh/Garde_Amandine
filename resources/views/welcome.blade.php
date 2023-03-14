<x-app-layout>
@vite('resources/css/welcome_page.scss')
    <section class="min-h-screen relative bg-perso -top-2">
        <div class="hero">
            <h1><span>Gard'</span></h1>
            <h1><span>Animaux</span></h1>
        </div>
        <p class="text-center">Sous-titre</p>
        
        <!-- BUTTON DOWN -->
        <div class="absolute bottom-0 left-0 right-0">
            <div class="flex justify-center">
                <a href="#tuto">
                    <svg class="animate-bounce h-16 w-16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#43abff;} .st1{opacity:0.2;} .st2{fill:#231F20;} .st3{fill:#FFFFFF;} </style> <g id="Layer_1"> <g> <circle class="st0" cx="32" cy="32" r="32"></circle> </g> <g class="st1"> <path class="st2" d="M47.8,30H40V18c0-2.2-1.8-4-4-4h-8c-2.2,0-4,1.8-4,4v12h-7.8c-2.7,0-3.5,1.9-1.7,4.1l14.3,18.1 c1.8,2.3,4.7,2.3,6.5,0l14.3-18.1C51.3,31.9,50.6,30,47.8,30z"></path> </g> <g> <path class="st3" d="M24,16c0-2.2,1.8-4,4-4h8c2.2,0,4,1.8,4,4v24c0,2.2-1.8,4-4,4h-8c-2.2,0-4-1.8-4-4V16z"></path> </g> <g> <path class="st3" d="M47.8,28c2.7,0,3.5,1.9,1.7,4.1L35.3,50.3c-1.8,2.3-4.7,2.3-6.5,0L14.5,32.1c-1.8-2.3-1-4.1,1.7-4.1H47.8z"></path> </g> </g> <g id="Layer_2"> </g> </g></svg>
                </a>
            </div>
        </div>
    </section>

    <section id="tuto" class="min-h-screen md:grid md:grid-cols-3 mt-4">
    <div class="bg-perso md:col-span-2">
        <div>
            <h2 class="font-medium text-lg">Comment faire garder son animal?</h2>
        </div>
    </div>
    <div class="bg-white mt-4" id="bg-man-cat">
        <!-- <img src="{{ asset('storage/site_photos/man-with_cat.png') }}" alt="">    -->
    </div>
    <div id="bg-woman-dog" class="mb-4">
    </div>
    <div class="bg-perso md:col-span-2">
        <div>
            <h2 class="font-medium text-lg">Comment devenir Pet-Sitter sur le site?</h2>
        </div>
    </div>
    </section>
</x-app-layout>