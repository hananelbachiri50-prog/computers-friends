<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier | Computer Friends</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cf-black': '#000000',
                        'cf-yellow': '#FFD700',
                        'cf-dark': '#111111',
                        'cf-gray': '#1a1a1a',
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000;
            color: #fff;
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
                
                <!-- Navbar -->
                <nav class="flex items-center gap-4">
                    <a href="/" class="text-white hover:text-yellow-500 flex items-center gap-2">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                    <a href="{{ route('cart') }}" class="text-yellow-500 flex items-center gap-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Panier</span>
                        @if(session('cart') && count(session('cart')) > 0)
                        <span class="w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold">
                            {{ count(session('cart')) }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('favorites') }}" class="text-white hover:text-yellow-500 flex items-center gap-2 relative">
                        <i class="fas fa-heart"></i>
                        <span class="hidden md:inline">Favoris</span>
                        @if(session('favorites') && count(session('favorites')) > 0)
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold">
                            {{ count(session('favorites')) }}
                        </span>
                        @endif
                    </a>
                    <a href="https://wa.me/212779517228" target="_blank" class="bg-green-500 text-white py-2 px-4 rounded-full flex items-center gap-2 hover:bg-green-600 transition-colors">
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
                        <a href="{{ route('register') }}" class="bg-yellow-500 text-black px-4 py-2 rounded-md font-bold hover:bg-yellow-400 transition">
                            <span class="hidden md:inline">Inscription</span>
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Success Message -->
    @if(session('success'))
    <div class="container mx-auto px-4 mt-6">
        <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-3 rounded-xl flex items-center gap-3 animate-pulse">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- CART SECTION -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-8 text-center">
                <span class="text-yellow-500">Votre</span> Panier
            </h1>
            
            @if(count($products) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Products List -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($products as $product)
                    <div class="bg-cf-gray rounded-2xl p-4 flex items-center gap-4 border border-gray-800">
                        <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}" class="w-24 h-24 object-contain">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm">{{ $product->specs }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xl font-bold text-yellow-500">{{ number_format($product->price, 0) }} DH</span>
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="bg-red-500/10 hover:bg-red-500/20 text-red-500 hover:text-red-400 border border-red-500/30 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-trash-alt"></i> Retirer
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-cf-gray rounded-2xl p-6 border border-gray-800 sticky top-24">
                        <h2 class="text-xl font-bold mb-4">Récapitulatif</h2>
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Prodphpuits</span>
                                <span>{{ count($products) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Sous-total</span>
                                <span class="text-yellow-500 font-semibold">{{ number_format($total, 0) }} DH</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Livraison</span>
                                <span class="text-green-500">Gratuite</span>
                            </div>
                            <div class="border-t border-gray-700 pt-3 flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-yellow-500">{{ number_format($total, 0) }} DH</span>
                            </div>
                        </div>
                        
                        <!-- WhatsApp Order Button (opens modal) -->
                        <button onclick="openOrderModal()"
                                class="whatsapp-btn w-full py-3 px-4 rounded-full font-semibold flex items-center justify-center gap-2 transition-all">
                            <i class="fab fa-whatsapp text-xl"></i>
                            Commander sur WhatsApp
                        </button>
                        
                        <a href="/" class="mt-3 block text-center text-gray-400 hover:text-yellow-500 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>Continuer les achats
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-16">
                <i class="fas fa-shopping-cart text-6xl text-gray-700 mb-6"></i>
                <h2 class="text-2xl font-bold mb-4">Votre panier est vide</h2>
                <p class="text-gray-400 mb-8">Découvrez nos produits et ajoutez-les à votre panier</p>
                <a href="/" class="btn-primary inline-block py-3 px-8 rounded-full font-semibold">
                    Voir les produits
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- FOOTER -->
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
                <p class="text-sm text-gray-400 mb-1">Produits dans le panier:</p>
                <ul class="text-white font-semibold">
                    @foreach($products as $product)
                    <li>• {{ $product->name }} - {{ number_format($product->price, 0) }} DH</li>
                    @endforeach
                </ul>
                <p class="text-yellow-500 font-bold mt-3 text-lg">Total: {{ number_format($total, 0) }} DH</p>
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

    <script>
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
            
            // Get products list
            const products = @json($products->pluck('name', 'price'));
            const total = '{{ number_format($total, 0) }}';
            
            // Build products list string
            let productsList = '';
            for (const [price, name] of Object.entries(products)) {
                productsList += '• ' + name + ' - ' + price + ' DH\n';
            }
            
            // Build WhatsApp message
            const message = `Bonjour,
Je veux commander les produits suivants :

${productsList}
Total: ${total} DH

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
