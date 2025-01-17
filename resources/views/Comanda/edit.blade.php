<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Comanda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('comandes.update', $comanda->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="productes" class="block text-sm font-medium text-gray-700">Productes Associats</label>
                        <select name="productes[]" id="productes" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($totsProductes as $producte)
                                <option value="{{ $producte->id }}" 
                                    @if(in_array($producte->id, $comanda->detallsComanda->pluck('id')->toArray())) selected @endif>
                                    {{ $producte->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="quantitats" class="block text-sm font-medium text-gray-700">Quantitat dels Productes</label>
                        <div>
                            @foreach ($comanda->detallsComanda as $detall)
                                <div class="flex items-center mb-2">
                                    <label for="quantitat_{{ $detall->id }}" class="mr-2">{{ $detall->nom }}</label>
                                    <input type="number" id="quantitat_{{ $detall->id }}" name="quantitat[{{ $detall->id }}]" value="{{ $detall->pivot->quantitat }}" class="w-16 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="1">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 rounded-md py-2 px-4">
                            Actualitzar Comanda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
