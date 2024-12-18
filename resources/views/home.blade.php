<x-guest-layout>
    <header class="w-full bg-black py-5 px-6 shadow-md">
        <nav class="flex justify-between items-center">
            <div class="space-x-6">
                <a href="#" class="text-yellow-500 hover:text-white">{{ __('Home') }}</a>
                <a href="#" class="text-yellow-500 hover:text-white">{{ __('Collections') }}</a>
                <a href="#" class="text-yellow-500 hover:text-white">{{ __('About') }}</a>
                @auth
                    <a href="#" class="text-yellow-500 hover:text-white">{{ __('Contact') }}</a>
                @endauth
            </div>
            <div class="flex items-center space-x-6">
                @auth
                    <!-- Logged-in User -->
                    <span class="text-yellow-500">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-yellow-500 hover:text-white">Logout</button>
                    </form>
                @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="text-yellow-500 hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:text-white">Register</a>
                @endauth
                <!-- Language Selector -->
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
                    <h1 class="text-4xl md:text-6xl font-bold mb-4 text-center md:text-left">{{ __('New Collection') }}</h1>
                    <p class="text-lg md:text-xl mb-8 text-center md:text-left">
                        {{ __('Discover Our New Collection') }}
                    </p>
                    <div class="flex space-x-4 justify-center md:justify-start">
                        <a href="#" class="bg-black text-yellow-500 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-600">{{ __('Buy Now') }}</a>
                        <a href="#" class="border border-black text-black px-6 py-3 rounded-lg hover:bg-black hover:text-yellow-500">{{ __('View Collection') }}</a>
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
            <h2 class="text-3xl md:text-4xl font-bold text-black mb-8">{{ __('Categories') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Sweater') }}</h3>
                    </div>
                </div>
                <div class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Pants') }}</h3>
                    </div>
                </div>
                <div class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Tshirt') }}</h3>
                    </div>
                </div>
                <div class="bg-yellow-500 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-black">{{ __('Shoes') }}</h3>
                    </div>
                </div>
            </div>
        </section>
    
        <section class="w-full bg-black text-yellow-500 py-16 px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-center">{{ __('Subscribe') }}</h2>
            <p class="text-yellow-200 mb-8 max-w-xl mx-auto text-center">
                {{ __('Subscribe to receive the latest trends, exclusive offers, and inspiration.') }}
            </p>
            <form class="max-w-md mx-auto flex flex-col md:flex-row gap-4">
                <input type="email" placeholder="{{ __('Your email address') }}" required class="flex-grow px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <button type="submit" class="bg-yellow-500 text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">{{ __('Subscribe Button') }}</button>
            </form>
        </section>
    </main>
    
    <footer class="w-full bg-black text-yellow-500 py-8">
        <div class="w-full px-4 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2024 NUDYY </p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-white">{{ __('Privacy Policy') }}</a>
                <a href="#" class="hover:text-white">{{ __('Terms') }}</a>
                <a href="#" class="hover:text-white">{{ __('Follow Us') }}</a>
            </div>
        </div>
    </footer>
</x-guest-layout>
