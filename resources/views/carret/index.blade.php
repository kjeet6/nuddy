<x-guest-layout>
    <!-- Header -->
    <header class="w-full bg-black py-5 px-6 shadow-md flex justify-between items-center">
        <h1 class="text-white text-xl font-bold">{{ __('Carrito') }}</h1>
        <div class="flex items-center space-x-6">
            <!-- Tornar a la botiga -->
            <a href="{{ route('coleccions.index') }}" class="text-yellow-500 hover:text-white">
                {{ __('Tornar a la botiga') }}
            </a>
            <!-- Selector d'idioma -->
            <form method="GET" id="language-form">
                <select name="language" class="bg-yellow-500 text-black px-2 py-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-600" onchange="window.location.href='/lang/' + this.value;">
                    <option value="ca" {{ session('idioma') == 'ca' ? 'selected' : '' }}>Català</option>
                    <option value="es" {{ session('idioma') == 'es' ? 'selected' : '' }}>Espanyol</option>
                    <option value="en" {{ session('idioma') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ session('idioma') == 'fr' ? 'selected' : '' }}>Français</option>
                </select>
            </form>
        </div>
    </header>

    <!-- Main -->
    <main class="p-6 bg-gray-100 min-h-screen">
        @if ($carret && $carret->detallsCarret->isNotEmpty())
            <div class="space-y-6">
                @foreach ($carret->detallsCarret as $detall)
                    <div class="bg-white p-4 rounded-lg shadow-lg flex items-center justify-between">
                        <!-- Informació del producte -->
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('img/' . $detall->producte->foto) }}" alt="{{ $detall->producte->nom }}" class="h-20 w-20 rounded-lg object-cover">
                            <div>
                                <h3 class="font-bold text-black">{{ $detall->producte->nom }}</h3>
                                <p class="text-gray-600">{{ __('Talla:') }} {{ $detall->producte->talla ?? '-' }}</p>
                                <p class="text-yellow-500">{{ __('Preu unitari:') }} €{{ $detall->producte->preu }}</p>
                            </div>
                        </div>
                        <!-- Accions del carret -->
                        <div class="flex items-center space-x-4">
                            <!-- Botó +1 -->
                            <form method="POST" action="{{ route('carret.afegir') }}">
                                @csrf
                                <input type="hidden" name="producte_id" value="{{ $detall->producte->id }}">
                                <button type="submit" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded">{{ __('+1') }}</button>
                            </form>
                            <!-- Botó -1 -->
                            <form method="POST" action="{{ route('carret.restar', $detall->producte->id) }}">
                                @csrf
                                <button type="submit" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded">{{ __('-1') }}</button>
                            </form>
                            <!-- Quantitat -->
                            <span class="font-bold text-black">{{ $detall->quantitat }}</span>
                            <!-- Botó Eliminar -->
                            <form method="POST" action="{{ route('carret.eliminar', $detall->producte->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white hover:bg-red-600 rounded">
                                    {{ __('Eliminar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Resum total -->
            <div class="mt-4 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold">{{ __('Total:') }} €{{ $total }}</h2>
                <button class="mt-4 bg-yellow-500 text-black px-4 py-2 rounded-full font-bold hover:bg-yellow-600 transition-colors">
                    {{ __('Finalitzar comanda') }}
                </button>
            </div>
        @else
            
            <p class="text-center text-gray-500">{{ __('El teu carret està buit') }}</p>
        @endif
    </main>

    <!-- Footer -->
    <footer class="w-full bg-black text-yellow-500 py-8 text-center">
        <p>&copy; 2024 NUDYY</p>
    </footer>
</x-guest-layout>
