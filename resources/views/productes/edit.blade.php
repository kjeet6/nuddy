<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Producte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('productes.update', $producte->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nom" class="block text-gray-700">Nom</label>
                        <input type="text" name="nom" id="nom" value="{{ $producte->nom }}" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label for="descripcio" class="block text-gray-700">Descripció</label>
                        <textarea name="descripcio" id="descripcio" rows="4" class="w-full border-gray-300 rounded-lg">{{ $producte->descripcio }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="preu" class="block text-gray-700">Preu (€)</label>
                        <input type="number" name="preu" id="preu" value="{{ $producte->preu }}" class="w-full border-gray-300 rounded-lg" step="0.01" required>
                    </div>

                    <div class="mb-4">
                        <label for="quantitat_stock" class="block text-gray-700">Quantitat en stock</label>
                        <input type="number" name="quantitat_stock" id="quantitat_stock" value="{{ $producte->quantitat_stock }}" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label for="categoria_id" class="block text-gray-700">Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="w-full border-gray-300 rounded-lg">
                            @foreach($categories as $categoria)
                                <option value="{{ $categoria->id }}" {{ $producte->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700">Foto</label>
                        <input type="file" name="foto" id="foto" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Actualitzar Producte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
