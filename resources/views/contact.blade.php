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
        <h1 class="text-4xl font-bold text-black mb-4">{{ __('Contacte') }}</h1>
        <p class="text-lg text-gray-700 max-w-3xl text-center mb-8">
            {{ __('Tens alguna pregunta? Contacta amb nosaltres mitjançant el formulari següent.') }}
        </p>
        <form action="#" method="POST" class="w-full max-w-lg bg-yellow-500 p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-black font-semibold">{{ __('Nom') }}</label>
                <input type="text" id="name" name="name" required class="w-full px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-yellow-600">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-black font-semibold">{{ __('Correu electrònic') }}</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-yellow-600">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-black font-semibold">{{ __('Missatge') }}</label>
                <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-yellow-600"></textarea>
            </div>
            <button type="submit" class="bg-black text-yellow-500 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                {{ __('Enviar') }}
            </button>
        </form>
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
