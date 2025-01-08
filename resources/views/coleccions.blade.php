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
                        <button type="submit" class="text-yellow-500 hover:text-white">{{ __('Logout') }}</button>
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

   
    <section class="bg-white shadow-md py-4 px-6 mb-6 rounded-lg">
        <div class="flex space-x-4 overflow-x-auto justify-center">
            <a href="{{ route('coleccions.index', ['categoria' => 'totes-les-peces']) }}"
               class="px-4 py-2 rounded-full {{ $categoriaSeleccionada == 'totes-les-peces' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black hover:bg-gray-300' }}">
                {{ __('Totes les peces') }}
            </a>
            @foreach ($categories as $categoria)
                @if (!empty($categoria->nom))
                    <a href="{{ route('coleccions.index', ['categoria' => $categoria->id]) }}"
                       class="px-4 py-2 rounded-full {{ $categoriaSeleccionada == $categoria->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black hover:bg-gray-300' }}">
                        {{ __($categoria->nom) }}
                    </a>
                @endif
            @endforeach
        </div>
    </section>

    <main class="p-6 bg-gray-100 min-h-screen">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse ($productes as $producte)
                <div class="bg-white border p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('img/' . $producte->foto) }}" alt="{{ $producte->nom }}" class="mb-4 rounded-lg object-cover h-48 w-full">
                    <h3 class="font-bold text-black truncate">{{ $producte->nom }}</h3>
                    <p class="text-gray-600 text-sm truncate">{{ $producte->descripcio }}</p>
                    <p class="text-yellow-500 font-semibold mt-2">{{ __('Preu:') }} €{{ $producte->preu }}</p>
                    
                    
                    <form method="POST" action="{{ route('carret.afegir') }}">
                        @csrf
                        <input type="hidden" name="producte_id" value="{{ $producte->id }}">
                        <button type="submit" class="mt-2 inline-block bg-yellow-500 text-black px-4 py-2 rounded-full font-bold hover:bg-yellow-600 transition-colors">
                            {{ __('Comprar ara') }}
                        </button>
                    </form>
                    
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">{{ __('No hi ha productes disponibles en aquesta categoria.') }}</p>
            @endforelse
        </div>
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
