<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestió de Comandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Graella de Comandes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($comandes as $comanda)
                        <div class="bg-white border rounded-lg shadow p-4">
                            <h4 class="font-semibold text-lg">Comanda #{{ $comanda->id }}</h4>
                            <p class="text-gray-600">Usuari: {{ $comanda->usuari?->name ?? 'Usuari no assignat' }}</p>
                            <p class="text-gray-600">Data: {{ $comanda->created_at?->format('d/m/Y H:i') ?? 'Data no disponible' }}</p>
                            <p class="text-gray-600">
                                Total Productes: {{ $comanda->detallsComanda->count() ?? 0 }}
                            </p>
                            <a href="#" class="text-blue-600 hover:underline">Veure Detalls</a>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-full">No hi ha comandes disponibles.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
