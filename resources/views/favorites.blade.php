<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris | Computer Friends</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cf-yellow': '#FFD700',
                        'cf-dark': '#111111',
                        'cf-gray': '#1a1a1a',
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000;
            color: #fff;
        }
        
        /* Product Card Hover Effects */
        .product-card {
            transition: all 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(255, 215, 0, 0.15);
            border-color: #FFD700;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #111;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #FFD700;
            border-radius: 4px;
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- HEADER -->
    <header class="bg-black border-b border-yellow-600/30 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-yellow-500 group-hover:border-yellow-400 transition-colors">
                        <img src="{{ asset('cfriiends.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <div class="text-2xl font-bold">
                        <span class="text-yellow-500">Computer</span>
                        <span class="text-white">Friends</span>
                    </div>
                </a>
                
                <!-- Search Bar -->
                <div class="flex-1 max-w-xl mx-4">
                    <form action="{{ route('home') }}" method="GET" class="relative">
                        <input type="text" 
                               name="search"
                               placeholder="Rechercher un produit..." 
                               class="w-full py-3 px-5 pr-12 rounded-full text-white placeholder-gray-400 bg-white/10 border border-yellow-500/30 focus:border-yellow-500 focus:outline-none transition">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center hover:bg-yellow-400 transition-colors">
                            <i class="fas fa-search text-black"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Navbar -->
                <nav class="flex items-center gap-4">
                    <a href="{{ route('favorites') }}" class="text-yellow-500 flex items-center gap-2">
                        <i class="fas fa-heart"></i>
                        <span class="hidden md:inline">Favoris</span>
                        @if(session('favorites') && count(session('favorites')) > 0)
                        <span class="w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold">
                            {{ count(session('favorites')) }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('cart') }}" class="text-white hover:text-yellow-500 flex items-center gap-2 transition relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hidden md:inline">Panier</span>
                        @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold">
                            {{ count(session('cart')) }}
                        </span>
                        @endif
                    </a>
                    <a href="https://wa.me/212779517228" target="_blank" class="bg-green-600 text-white py-2 px-4 rounded-full flex items-center gap-2 hover:bg-green-500 transition">
                        <i class="fab fa-whatsapp"></i>
                        <span class="hidden md:inline">Need Help</span>
                    </a>
                    
                    @auth
                        <!-- User Greeting -->
                        <div class="flex items-center gap-2 mr-2 border-r border-gray-700 pr-4">
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
                            <button type="submit" class="text-white hover:text-yellow-500 transition">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                <span class="hidden md:inline">Déconnexion</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-yellow-500 transition">
                            <i class="fas fa-sign-in-alt"></i>
                            <span class="hidden md:inline">Connexion</span>
                        </a>
                        <a href="{{ route('register') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">
                            <span class="hidden md:inline">Inscription</span>
                            <span class="md:hidden"><i class="fas fa-user-plus"></i></span>
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-4 py-12">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4">
                <span class="text-yellow-500">Mes</span> Favoris
            </h1>
            <div class="w-24 h-1 bg-yellow-500 mx-auto rounded-full"></div>
            <p class="text-gray-400 mt-4">
                @if($products->count() > 0)
                    {{ $products->count() }} produit(s) dans vos favoris
                @else
                    Vous n'avez pas encore de produits favoris
                @endif
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-500/20 border border-green-500 text-green-400 px-6 py-4 rounded-xl mb-8 text-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
        @endif

        <!-- Products Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="product-card bg-cf-gray rounded-2xl overflow-hidden border border-gray-800">
                <!-- Product Image -->
                <div class="relative overflow-hidden group">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->img) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                    </a>
                    <div class="absolute top-3 right-3">
                        <button type="button"
                                onclick="toggleFavorite({{ $product->id }}, this)"
                                class="w-10 h-10 bg-yellow-500 text-black rounded-full flex items-center justify-center transition-all hover:bg-red-500 hover:text-white">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-white mb-2 truncate">{{ $product->name }}</h3>
                    
                    <!-- Specs Badge -->
                    @if($product->specs)
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach(explode('|', $product->specs) as $spec)
                        <span class="text-xs bg-yellow-500/20 text-yellow-500 px-2 py-1 rounded">
                            {{ trim($spec) }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                    
                    <!-- Description -->
                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                    
                    <!-- Price and Add to Cart -->
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-yellow-500">{{ number_format($product->price, 0) }} DH</span>
                        <button onclick="addToCart({{ $product->id }})" class="bg-yellow-500 text-black px-4 py-2 rounded-full font-semibold text-sm hover:bg-white transition-colors">
                            <i class="fas fa-cart-plus mr-2"></i>Ajouter
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Continue Shopping Button -->
        <div class="text-center mt-12">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 border-2 border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-black px-8 py-3 rounded-full font-semibold transition-all duration-300">
                <i class="fas fa-arrow-left"></i>
                Continuer les achats
            </a>
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-heart text-4xl text-gray-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Aucun favori</h3>
            <p class="text-gray-400 mb-8">Explorez notre catalogue et ajoutez vos produits préférés</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-yellow-500 text-black px-8 py-3 rounded-full font-semibold hover:bg-yellow-400 transition-all duration-300">
                <i class="fas fa-shopping-bag"></i>
                Découvrir les produits
            </a>
        </div>
        @endif
    </main>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Add to Cart JavaScript -->
    <script>
        // Toggle favorite function
        function toggleFavorite(productId, button) {
            fetch('/favorites/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const heartIcon = button.querySelector('i');

                    if (data.inFavorites) {
                        // Product added to favorites (shouldn't happen on favorites page, but handle it)
                        button.classList.remove('bg-black/50', 'text-white');
                        button.classList.add('bg-yellow-500', 'text-black');
                        heartIcon.classList.remove('far');
                        heartIcon.classList.add('fas');
                    } else {
                        // Product removed from favorites - remove the card from DOM
                        button.closest('.product-card').remove();

                        // Update counter text
                        const counter = document.querySelector('.text-gray-400.mt-4');
                        if (counter) {
                            const remaining = document.querySelectorAll('.product-card').length;
                            if (remaining > 0) {
                                counter.textContent = remaining + ' produit(s) dans vos favoris';
                            } else {
                                counter.textContent = 'Vous n\'avez pas encore de produits favoris';
                                // Show empty state
                                location.reload();
                            }
                        }

                        // Update navbar badge
                        const favLink = document.querySelector('a[href="/favorites"]');
                        if (favLink) {
                            let badge = favLink.querySelector('span');
                            if (data.favoritesCount > 0) {
                                if (!badge) {
                                    badge = document.createElement('span');
                                    badge.className = 'w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold';
                                    favLink.appendChild(badge);
                                }
                                badge.textContent = data.favoritesCount;
                            } else if (badge) {
                                badge.remove();
                            }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error toggling favorite:', error);
            });
        }

        function addToCart(productId) {
            fetch('/cart/add/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count in navbar
                    const cartLink = document.querySelector('a[href="/cart"]');
                    if (cartLink) {
                        let badge = cartLink.querySelector('span.absolute');
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold';
                            cartLink.appendChild(badge);
                        }
                        badge.textContent = data.cartCount;
                    }
                    
                    // Show success notification
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
        }
    </script>

</body>
</html>
