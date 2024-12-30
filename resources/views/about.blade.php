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
            </div>
            <div class="flex items-center space-x-6">
                @auth
                    <span class="text-yellow-500">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-yellow-500 hover:text-white">{{ __('Tancar sessió') }}</button>
                    </form>

                    <!-- Icona del carret -->
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

    <main class="w-full bg-white min-h-screen flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold text-black mb-4">{{ __('Sobre nosaltres') }}</h1>
        <p class="text-lg text-gray-700 max-w-3xl text-center">
            {{ __('Som una empresa dedicada a oferir roba de qualitat amb les últimes tendències i dissenys innovadors. La nostra missió és portar estil i comoditat als nostres clients.') }}
        </p>
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
