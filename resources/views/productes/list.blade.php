<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestió de Productes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('productes.create') }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Afegir Producte
                    </a>
                </div>
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">Foto</th>
                            <th class="border px-4 py-2">Nom</th>
                            <th class="border px-4 py-2">Preu</th>
                            <th class="border px-4 py-2">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productes as $producte)
                            <tr>
                                <td class="border px-4 py-2">
                                    <img src="{{ asset('img/' . $producte->foto) }}" alt="{{ $producte->nom }}" class="w-16 h-16 object-cover">
                                </td>
                                <td class="border px-4 py-2">{{ $producte->nom }}</td>
                                <td class="border px-4 py-2">{{ $producte->preu }} €</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('productes.edit', $producte->id) }}" 
                                       class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Editar
                                    </a>
                                    <form action="{{ route('productes.destroy', $producte->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-600 py-4">No hi ha productes disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
