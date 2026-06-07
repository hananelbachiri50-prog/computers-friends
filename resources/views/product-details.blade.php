<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Computer Friends</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cf-yellow': '#FFD700',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #000;
            color: #fff;
        }
        
        /* Thumbnail hover effect */
        .gallery-thumb {
            transition: all 0.3s ease;
        }
        
        .gallery-thumb:hover {
            border-color: #FFD700;
            transform: scale(1.05);
        }
        
        .gallery-thumb.active {
            border-color: #FFD700;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
        }
        
        /* Main image transition */
        #mainImage {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        
        #mainImage:hover {
            transform: scale(1.02);
        }
        
        /* Button glow effect */
        .btn-glow {
            transition: all 0.3s ease;
        }
        
        .btn-glow:hover {
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            transform: translateY(-2px);
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
                    <a href="{{ route('favorites') }}" class="text-white hover:text-yellow-500 flex items-center gap-2 relative">
                        <i class="fas fa-heart"></i>
                        <span class="hidden md:inline">Favoris</span>
                        @if(session('favorites') && count(session('favorites')) > 0)
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold">
                            {{ count(session('favorites')) }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('cart') }}" class="text-white hover:text-yellow-500 flex items-center gap-2 relative">
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

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
            
            <!-- Left Column: Image Gallery -->
            <div class="space-y-6">
                <!-- Main Image Card -->
                <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-white/5">
                    <img id="mainImage" 
                         src="{{ asset('storage/' . $product->img) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-80 md:h-[500px] object-contain mx-auto">
                </div>
                
                <!-- Thumbnails Gallery -->
                @if($product->gallery && count($product->gallery) > 0)
                <div class="flex gap-4 overflow-x-auto pb-2">
                    <!-- Main image thumbnail -->
                    <button onclick="changeImage('{{ asset('storage/' . $product->img) }}', this)" 
                            class="gallery-thumb active flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-2xl border-2 border-yellow-500 bg-white p-2 overflow-hidden">
                        <img src="{{ asset('storage/' . $product->img) }}" 
                             alt="Main" 
                             class="w-full h-full object-contain">
                    </button>
                    
                    <!-- Gallery thumbnails -->
                    @foreach($product->gallery as $galleryImage)
                    <button onclick="changeImage('{{ asset('storage/' . $galleryImage) }}', this)" 
                            class="gallery-thumb flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-2xl border-2 border-zinc-700 bg-white p-2 overflow-hidden hover:border-yellow-500">
                        <img src="{{ asset('storage/' . $galleryImage) }}" 
                             alt="Gallery" 
                             class="w-full h-full object-contain">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Right Column: Product Information -->
            <div class="flex flex-col justify-center space-y-8">
                
                <!-- Product Title -->
                <div>
                    <h1 class="text-white text-3xl md:text-4xl font-black uppercase tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>
                </div>

                <!-- Price -->
                <div>
                    <span class="text-yellow-500 text-3xl md:text-4xl font-bold">
                        {{ number_format($product->price, 0, '.', ' ') }} DH
                    </span>
                </div>

                <!-- Specs Badges -->
                @if($product->specs)
                <div class="flex flex-wrap gap-3">
                    @foreach(explode('|', $product->specs) as $spec)
                    <span class="bg-zinc-800 text-zinc-400 px-4 py-2 rounded-xl text-sm font-medium uppercase tracking-wide">
                        {{ trim($spec) }}
                    </span>
                    @endforeach
                </div>
                @endif

                <!-- Description -->
                <div class="text-zinc-300 leading-relaxed text-base md:text-lg">
                    {{ $product->description ?? 'Aucune description disponible pour ce produit.' }}
                </div>

                <!-- Features List -->
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-zinc-300">
                        <div class="w-8 h-8 rounded-full bg-yellow-500/20 flex items-center justify-center">
                            <i class="fas fa-check text-yellow-500 text-sm"></i>
                        </div>
                        <span class="text-sm">Produit 100% original et authentique</span>
                    </div>
                    <div class="flex items-center gap-3 text-zinc-300">
                        <div class="w-8 h-8 rounded-full bg-yellow-500/20 flex items-center justify-center">
                            <i class="fas fa-shield text-yellow-500 text-sm"></i>
                        </div>
                        <span class="text-sm">Garantie 3 mois incluse</span>
                    </div>
                    <div class="flex items-center gap-3 text-zinc-300">
                        <div class="w-8 h-8 rounded-full bg-yellow-500/20 flex items-center justify-center">
                            <i class="fas fa-truck text-yellow-500 text-sm"></i>
                        </div>
                        <span class="text-sm">Livraison rapide partout au Maroc</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4 pt-4">
                    <!-- Add to Cart Button -->
                    <button onclick="addToCart({{ $product->id }})" 
                            class="btn-glow w-full bg-yellow-500 text-black py-4 px-6 rounded-2xl font-bold text-lg flex items-center justify-center gap-3">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Ajouter au panier</span>
                    </button>
                    
                    <!-- Secondary Actions Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Commander Button (opens modal) -->
                        <button onclick="openOrderModal()"
                                class="btn-glow bg-green-600 text-white py-4 px-6 rounded-2xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-green-500 transition">
                            <i class="fab fa-whatsapp"></i>
                            <span>Commander</span>
                        </button>
                        
                        <!-- Favorite Button -->
                        <button onclick="toggleFavorite({{ $product->id }}, this)"
                                data-is-favorite="{{ in_array($product->id, $favorites ?? []) ? 'true' : 'false' }}"
                                class="btn-glow py-4 px-6 rounded-2xl font-bold text-sm flex items-center justify-center gap-2 transition border border-zinc-700 {{ in_array($product->id, $favorites ?? []) ? 'bg-yellow-500 text-black' : 'bg-zinc-800 text-white hover:bg-zinc-700' }}">
                            <i class="{{ in_array($product->id, $favorites ?? []) ? 'fas' : 'far' }} fa-heart"></i>
                            <span>{{ in_array($product->id, $favorites ?? []) ? 'Aimé' : 'Favoris' }}</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Order Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white">Finaliser la commande</h3>
                <button onclick="closeOrderModal()" class="text-gray-400 hover:text-white transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="mb-6 bg-zinc-800/50 rounded-xl p-4">
                <p class="text-sm text-gray-400 mb-1">Produit:</p>
                <p class="text-white font-semibold">{{ $product->name }}</p>
                <p class="text-yellow-500 font-bold mt-1">{{ number_format($product->price, 0, '.', ' ') }} DH</p>
            </div>

            <form id="orderForm" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nom *</label>
                    <input type="text" name="nom" id="nom" required
                           class="w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:outline-none focus:border-yellow-500 transition"
                           placeholder="Votre nom">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" required
                           class="w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:outline-none focus:border-yellow-500 transition"
                           placeholder="Votre prénom">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Téléphone *</label>
                    <input type="tel" name="telephone" id="telephone" required
                           class="w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:outline-none focus:border-yellow-500 transition"
                           placeholder="06 XX XX XX XX">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Adresse *</label>
                    <textarea name="adresse" id="adresse" rows="3" required
                              class="w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:outline-none focus:border-yellow-500 transition resize-none"
                              placeholder="Votre adresse complète"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn-glow w-full bg-green-600 text-white py-4 px-6 rounded-2xl font-bold text-lg flex items-center justify-center gap-2">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span>Envoyer la commande sur WhatsApp</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification Toast Container -->
    <div id="toastContainer" class="fixed top-24 right-4 z-50 space-y-3"></div>

    <!-- Image Gallery JavaScript -->
    <script>
        // Product data for notifications
        const productData = {
            id: {{ $product->id }},
            name: '{{ addslashes($product->name) }}',
            price: '{{ number_format($product->price, 0, ".", " ") }}'
        };

        // Toast notification system
        function showToast(message, type = 'success', duration = 3000) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            
            const bgColors = {
                success: 'bg-gradient-to-r from-yellow-500 to-yellow-600',
                error: 'bg-gradient-to-r from-red-500 to-red-600',
                info: 'bg-gradient-to-r from-blue-500 to-blue-600',
                warning: 'bg-gradient-to-r from-orange-500 to-orange-600'
            };
            
            const icons = {
                success: '<i class="fas fa-check-circle"></i>',
                error: '<i class="fas fa-exclamation-circle"></i>',
                info: '<i class="fas fa-info-circle"></i>',
                warning: '<i class="fas fa-exclamation-triangle"></i>'
            };
            
            toast.className = `${bgColors[type]} text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 transform translate-x-full opacity-0 transition-all duration-500 max-w-sm`;
            toast.innerHTML = `
                <span class="text-xl">${icons[type]}</span>
                <span class="font-medium">${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-white/70 hover:text-white transition">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 10);
            
            // Auto remove
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, duration);
        }

        // Update cart badge in navbar
        function updateCartBadge(count) {
            const cartUrl = "{{ route('cart') }}";
            const cartLink = document.querySelector(`a[href="${cartUrl}"]`);
            if (cartLink) {
                let badge = cartLink.querySelector('.cart-badge');
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold cart-badge';
                    cartLink.appendChild(badge);
                }
                badge.textContent = count;
                // Add animation
                badge.classList.add('animate-bounce');
                setTimeout(() => badge.classList.remove('animate-bounce'), 1000);
            }
        }

        // Update favorites badge in navbar
        function updateFavoritesBadge(count) {
            const favUrl = "{{ route('favorites') }}";
            const favLink = document.querySelector(`a[href="${favUrl}"]`);
            if (favLink) {
                let badge = favLink.querySelector('.fav-badge');
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold fav-badge';
                    favLink.appendChild(badge);
                }
                badge.textContent = count;
                badge.classList.add('animate-bounce');
                setTimeout(() => badge.classList.remove('animate-bounce'), 1000);
            }
        }

        // Image gallery functions
        function changeImage(src, thumbnail) {
            const mainImage = document.getElementById('mainImage');
            
            mainImage.style.opacity = '0';
            mainImage.style.transform = 'scale(0.98)';
            
            setTimeout(() => {
                mainImage.src = src;
                mainImage.style.opacity = '1';
                mainImage.style.transform = 'scale(1)';
            }, 150);
            
            document.querySelectorAll('.gallery-thumb').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('border-yellow-500');
                btn.classList.add('border-zinc-700');
            });
            
            thumbnail.classList.add('active');
            thumbnail.classList.remove('border-zinc-700');
        }

        // Add to cart function
        function addToCart(productId) {
            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count in navbar
                    updateCartBadge(data.cartCount);
                    
                    // Show appropriate notification
                    if (data.action === 'exists') {
                        showToast('Déjà dans le panier', 'warning');
                    } else {
                        showToast('Produit ajouté au panier avec succès', 'success');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Une erreur est survenue', 'error');
            });
        }

        // Toggle favorite function
        function toggleFavorite(productId, favoriteBtn) {
            const icon = favoriteBtn.querySelector('i');
            const textSpan = favoriteBtn.querySelector('span');
            const isCurrentlyFavorite = favoriteBtn.dataset.isFavorite === 'true';
            
            fetch(`/favorites/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.inFavorites) {
                        // Product is now in favorites
                        favoriteBtn.dataset.isFavorite = 'true';
                        favoriteBtn.classList.remove('bg-zinc-800', 'text-white');
                        favoriteBtn.classList.add('bg-yellow-500', 'text-black');
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        textSpan.textContent = 'Aimé';
                        showToast('Produit ajouté aux favoris', 'success');
                    } else {
                        // Product was removed from favorites
                        favoriteBtn.dataset.isFavorite = 'false';
                        favoriteBtn.classList.remove('bg-yellow-500', 'text-black');
                        favoriteBtn.classList.add('bg-zinc-800', 'text-white');
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        textSpan.textContent = 'Favoris';
                        showToast('Produit retiré des favoris', 'info');
                    }
                    
                    // Update favorites badge
                    updateFavoritesBadge(data.favoritesCount);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Une erreur est survenue', 'error');
            });
        }

        // Order modal functions
        function openOrderModal() {
            document.getElementById('orderModal').classList.remove('hidden');
        }

        function closeOrderModal() {
            document.getElementById('orderModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('orderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });

        // Handle order form submission
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            const telephone = document.getElementById('telephone').value;
            const adresse = document.getElementById('adresse').value;
            const productName = '{{ $product->name }}';
            const price = '{{ number_format($product->price, 0, ".", " ") }}';
            
            // Build WhatsApp message
            const message = `Bonjour,
Je veux commander ce produit :

Nom produit : ${productName}
Prix : ${price} DH

Mes informations :
Nom : ${nom}
Prénom : ${prenom}
Téléphone : ${telephone}
Adresse : ${adresse}

Merci de confirmer ma commande.`;

            // Encode and open WhatsApp
            const whatsappUrl = `https://wa.me/212779517228?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
            
            closeOrderModal();
        });
    </script>
</body>
</html>
