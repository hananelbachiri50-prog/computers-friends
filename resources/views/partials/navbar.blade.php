<nav class="flex items-center justify-between px-6 py-4 bg-black text-white border-b border-gray-800 sticky top-0 z-50">
    <div class="flex items-center gap-3">
        <img src="{{ asset('cfriiends.jpg') }}" alt="Logo" class="w-10 h-10 object-cover rounded-full border border-yellow-500">
        <span class="text-yellow-500 font-bold text-xl tracking-wider">COMPUTER FRIENDS</span>
    </div>

    <div class="flex-grow mx-10 max-w-xl">
        <form action="{{ route('home') }}" method="GET" class="relative">
            <input type="text" name="search" placeholder="Rechercher un produit..." 
                   value="{{ request('search') }}"
                   class="w-full bg-gray-900 text-sm border border-gray-700 rounded-lg py-2 px-4 focus:outline-none focus:border-yellow-500 transition">
            <button type="submit" class="absolute right-3 top-2 text-gray-400 hover:text-yellow-500">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="flex items-center gap-6">
        <div class="flex gap-4 border-r border-gray-700 pr-4">
            <a href="{{ route('favorites') }}" class="relative hover:text-yellow-500 transition">
                <i class="far fa-heart text-xl"></i>
                <span id="favorites-count" class="absolute -top-2 -right-2 bg-yellow-500 text-black text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ count(session('favorites', [])) }}</span>
            </a>
            <a href="{{ route('cart') }}" class="relative hover:text-yellow-500 transition">
                <i class="fas fa-shopping-cart text-xl"></i>
                <span id="cart-count" class="absolute -top-2 -right-2 bg-yellow-500 text-black text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ count(session('cart', [])) }}</span>
            </a>
        </div>

        <div class="flex items-center gap-3 text-sm">
            @auth
                <!-- User Greeting -->
                <div class="flex items-center gap-2 mr-2">
                    <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-black font-bold text-sm">
                        {{ substr(auth()->user()->prenom ?? auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="hidden md:block">
                        <p class="text-xs text-gray-400">Bonjour,</p>
                        <p class="text-sm font-medium text-yellow-500">{{ auth()->user()->prenom ?? auth()->user()->name }}</p>
                    </div>
                </div>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 text-white px-3 py-1.5 rounded-md text-xs font-bold hover:bg-purple-500 transition">
                        <i class="fas fa-cog mr-1"></i> Admin
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-yellow-500 font-medium transition">
                        <i class="fas fa-sign-out-alt mr-1"></i>Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-yellow-500 font-medium transition">Se connecter</a>
                <span class="text-gray-600">|</span>
                <a href="{{ route('register') }}" class="bg-yellow-500 text-black px-4 py-2 rounded-md font-bold hover:bg-yellow-400 transition">S'inscrire</a>
            @endauth
        </div>

    </div>
</nav>

