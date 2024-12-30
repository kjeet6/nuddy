@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 px-4">
        <div class="bg-white shadow-md rounded-lg">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-semibold text-gray-800">Gestió d'usuaris</h2>
            </div>
            <div class="p-6">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table-auto w-full border border-gray-300 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border">Nom</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Rol</th>
                            <th class="px-4 py-2 border">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <select name="is_admin" class="rounded border-gray-300 text-gray-700 py-1 px-3">
                                            <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Client</option>
                                            <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Administrador</option>
                                        </select>
                                </td>
                                <td class="px-4 py-2">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded">Modificar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
