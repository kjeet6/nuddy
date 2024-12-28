<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Botiga de Roba') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Botons de categories -->
                <h3 class="text-lg font-semibold mb-4">Categories</h3>
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('productes.index') }}" 
                       class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                        Totes les peces
                    </a>
                    @foreach ($categories as $categoria)
                        @if (!empty($categoria->nom)) {{-- Mostra només categories amb nom vàlid --}}
                            <a href="{{ route('productes.index', ['categoria' => $categoria->id]) }}"
                               class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                                {{ $categoria->nom }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <!-- Graella de productes -->
                <h3 class="text-lg font-semibold mb-4">Tots els productes</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($productes as $producte)
                        <div class="bg-white border rounded-lg shadow">
                            <img src="{{ asset('img/' . $producte->foto) }}" alt="{{ $producte->nom }}" 
                                class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h4 class="font-semibold text-lg">{{ $producte->nom }}</h4>
                                <p class="text-gray-600">{{ $producte->descripcio }}</p>
                                <p class="text-gray-600">Preu: <span class="text-blue-600 font-bold">{{ $producte->preu }} €</span></p>
                                <a href="#" class="text-blue-600 hover:underline">+ Info</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-full">No hi ha productes disponibles.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
