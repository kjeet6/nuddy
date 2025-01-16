<x-guest-layout>
    <header class="w-full bg-black py-5 px-6 shadow-md">
        <nav class="flex justify-between items-center">
            <div class="space-x-6">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-white' : 'text-yellow-500 hover:text-white' }}">
                    {{ __('Inici') }}
                </a>
                <a href="{{ route('coleccions.index') }}" class="{{ request()->routeIs('coleccions.index') ? 'text-white' : 'text-yellow-500 hover:text-white' }}">
                    {{ __('Col·leccions') }}
                </a>
                <a href="{{ route('sobre-nosaltres') }}" class="{{ request()->routeIs('sobre-nosaltres') ? 'text-white' : 'text-yellow-500 hover:text-white' }}">
                    {{ __('Sobre nosaltres') }}
                </a>
                <a href="{{ route('contacte') }}" class="{{ request()->routeIs('contacte') ? 'text-white' : 'text-yellow-500 hover:text-white' }}">
                    {{ __('Contacte') }}
                </a>
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-yellow-500 hover:text-white' }}">
                            {{ __('Dashboard') }}
                        </a>
                    @endif
                @endauth
            </div>
            <div class="flex items-center space-x-6">
                @auth
                    <span class="text-yellow-500">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-yellow-500 hover:text-white">{{ __('Tancar sessió') }}</button>
                    </form>
                    @php
                        $quantitatTotal = Auth::user()->carret 
                            ? Auth::user()->carret->detallsCarret->sum('quantitat') 
                            : 0;
                    @endphp
                    <a href="{{ route('carret.index') }}" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13l-1.5 8.1M17 13l1.5 8.1M9 21h6M9 5h6" />
                        </svg>
                        @if($quantitatTotal > 0)
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
                                {{ $quantitatTotal }}
                            </span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-yellow-500 hover:text-white">{{ __('Iniciar sessió') }}</a>
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:text-white">{{ __('Registrar-se') }}</a>
                @endauth
                <form method="GET" id="language-form">
                    <select name="language" class="bg-yellow-500 text-black px-2 py-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-600" onchange="window.location.href='/lang/' + this.value;">
                        <option value="ca" {{ session('idioma') == 'ca' ? 'selected' : '' }}>Català</option>
                        <option value="es" {{ session('idioma') == 'es' ? 'selected' : '' }}>Espanyol</option>
                        <option value="en" {{ session('idioma') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="fr" {{ session('idioma') == 'fr' ? 'selected' : '' }}>Français</option>
                    </select>
                </form>
            </div>
        </nav>
    </header>

    <main class="w-full bg-white min-h-screen">
        <section class="w-full py-12 bg-gradient-to-r from-yellow-500 to-yellow-700">
            <div class="max-w-5xl mx-auto text-center">
                <h1 class="text-5xl font-extrabold text-black">{{ __('Sobre nosaltres') }}</h1>
                <p class="text-lg text-gray-100 mt-4">{{ __('Descobreix qui som, la nostra història i què ens fa únics.') }}</p>
            </div>
        </section>

        <section class="py-16 bg-gray-100">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-black mb-4">{{ __('La nostra missió') }}</h2>
                    <p class="text-lg text-gray-700">{{ __('A NUDYY, treballem per oferir roba que no només segueixi les últimes tendències, sinó que també prioritzin la qualitat, la sostenibilitat i el confort. Creiem en l’empoderament dels nostres clients perquè es sentin segurs i autèntics amb cada peça que porten.') }}</p>
                </div>
                <img src="/img/nuddy.png" alt="{{ __('La nostra missió') }}" class="rounded-lg shadow-md">
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-black mb-4">{{ __('Els nostres valors') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-yellow-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-black">{{ __('Innovació') }}</h3>
                        <p class="text-gray-700 mt-2">{{ __('Ens esforcem a introduir dissenys moderns i creatius en cada col·lecció.') }}</p>
                    </div>
                    <div class="bg-yellow-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-black">{{ __('Qualitat') }}</h3>
                        <p class="text-gray-700 mt-2">{{ __('Treballem amb materials d’alta qualitat per garantir la durabilitat i el confort.') }}</p>
                    </div>
                    <div class="bg-yellow-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-black">{{ __('Sostenibilitat') }}</h3>
                        <p class="text-gray-700 mt-2">{{ __('Estem compromesos amb pràctiques responsables per protegir el nostre planeta.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-100">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <img src="/img/team.png" alt="{{ __('El nostre equip') }}" class="rounded-lg shadow-md">
                <div>
                    <h2 class="text-3xl font-bold text-black mb-4">{{ __('Coneix el nostre equip') }}</h2>
                    <p class="text-lg text-gray-700">{{ __('Darrere de NUDYY hi ha un equip divers i apassionat. Des de dissenyadors creatius fins a experts en atenció al client, cadascun de nosaltres treballa per garantir una experiència inoblidable.') }}</p>
                </div>
            </div>
        </section>

        <section class="py-16 bg-yellow-500 text-white text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold">{{ __('Uneix-te a la nostra comunitat!') }}</h2>
                <p class="text-lg mt-4">{{ __('Segueix-nos a les xarxes socials per estar al dia de les nostres novetats i promocions exclusives.') }}</p>
                <div class="flex justify-center space-x-4 mt-6">
                    <a href="#" class="hover:text-black"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="hover:text-black"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="hover:text-black"><i class="fab fa-twitter fa-2x"></i></a>
                </div>
            </div>
        </section>
    </main>

    <footer class="w-full bg-black text-yellow-500 py-8">
        <div class="w-full px-4 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2024 NUDYY </p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-white">{{ __('Política de privacitat') }}</a>
                <a href="#" class="hover:text-white">{{ __('Termes i condicions') }}</a>
                <a href="#" class="hover:text-white">{{ __('Segueix-nos') }}</a>
            </div>
        </div>
    </footer>
</x-guest-layout>
