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

    <main>
        <section class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-black min-h-screen flex items-center justify-center">
            <div class="w-full px-4 grid md:grid-cols-2 items-center gap-8">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold mb-4 text-center md:text-left">{{ __('Noves Col·leccions') }}</h1>
                    <p class="text-lg md:text-xl mb-8 text-center md:text-left">
                        {{ __('Descobreix la nostra nova Col·lecció') }}
                    </p>
                    <div class="flex space-x-4 justify-center md:justify-start">
                        <a href="{{ route('coleccions.index') }}" class="bg-black text-yellow-500 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-600">{{ __('Compra ara') }}</a>
                        <a href="{{ route('coleccions.index') }}" class="border border-black text-black px-6 py-3 rounded-lg hover:bg-black hover:text-yellow-500">{{ __('Veure col·lecció') }}</a>
                    </div>
                </div>
                <div class="flex justify-center md:justify-end">
                    <img src="{{ asset('img/campanya-nuddy.jpg') }}" 
                         alt="Campanya Nuddy Project" 
                         class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>
        </section>

        <section class="w-full py-16 px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-black mb-8">{{ __('Categories destacades') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="{{ route('coleccions.index', ['categoria' => 5]) }}" class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Jaquetes') }}</h3>
                    </div>
                </a>
                <a href="{{ route('coleccions.index', ['categoria' => 3]) }}" class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Pantalons') }}</h3>
                    </div>
                </a>
                <a href="{{ route('coleccions.index', ['categoria' => 4]) }}" class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Samarretes') }}</h3>
                    </div>
                </a>
                <a href="{{ route('coleccions.index', ['categoria' => 7]) }}" class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Sabates') }}</h3>
                    </div>
                </a>
            </div>
        </section>

        <section class="w-full bg-black text-yellow-500 py-16 px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-center">{{ __('Subscriu-te') }}</h2>
            <p class="text-yellow-200 mb-8 max-w-xl mx-auto text-center">
                {{ __('Subscriu-te per rebre les últimes tendències, ofertes exclusives i inspiració') }}
            </p>
            <form class="max-w-md mx-auto flex flex-col md:flex-row gap-4">
                <input type="email" placeholder="{{ __('Correu electrònic') }}" required class="flex-grow px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <button type="submit" class="bg-yellow-500 text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">{{ __('Subscriu-te') }}</button>
            </form>
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
