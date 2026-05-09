<nav class="flex items-center justify-between px-6 py-4 bg-black text-white border-b border-gray-800">
    <div class="flex items-center gap-3">
        <img src="{{ asset('cfriiends.jpg') }}" alt="Logo" class="w-10 h-10 object-cover rounded-full border border-yellow-500">
        <span class="text-yellow-500 font-bold text-xl tracking-wider">COMPUTER FRIENDS</span>
    </div>

    <div class="flex-grow mx-10 max-w-xl">
        <form action="/search" method="GET" class="relative">
            <input type="text" name="query" placeholder="Rechercher un produit..." 
                   class="w-full bg-gray-900 text-sm border border-gray-700 rounded-lg py-2 px-4 focus:outline-none focus:border-yellow-500 transition">
            <button type="submit" class="absolute right-3 top-2 text-gray-400 hover:text-yellow-500">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="flex items-center gap-6">
        <div class="flex gap-4 border-r border-gray-700 pr-4">
            <a href="/favoris" class="relative hover:text-yellow-500 transition">
                <i class="far fa-heart text-xl"></i>
                <span class="absolute -top-2 -right-2 bg-yellow-500 text-black text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">0</span>
            </a>
            <a href="/panier" class="relative hover:text-yellow-500 transition">
                <i class="fas fa-shopping-cart text-xl"></i>
                <span class="absolute -top-2 -right-2 bg-yellow-500 text-black text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">0</span>
            </a>
        </div>

        <div class="flex items-center gap-3 text-sm">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="hover:text-yellow-500 font-medium">Se connecter</a>
            @else
                <a href="/login" class="hover:text-yellow-500 font-medium">Se connecter</a>
            @endif

            <span class="text-gray-600">|</span>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-yellow-500 text-black px-4 py-2 rounded-md font-bold hover:bg-yellow-400 transition">S'inscrire</a>
            @else
                <a href="/register" class="bg-yellow-500 text-black px-4 py-2 rounded-md font-bold hover:bg-yellow-400 transition">S'inscrire</a>
            @endif
        </div>

    </div>
</nav>

