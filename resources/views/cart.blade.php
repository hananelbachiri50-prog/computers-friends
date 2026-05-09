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
                    <a href="https://wa.me/212779517228" target="_blank" class="bg-green-500 text-white py-2 px-4 rounded-full flex items-center gap-2 hover:bg-green-600 transition-colors">
                        <i class="fab fa-whatsapp"></i>
                        <span class="hidden md:inline">Need Help</span>
                    </a>
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
                        <img src="{{ asset('product/' . $product->img) }}" alt="{{ $product->name }}" class="w-24 h-24 object-contain">
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
                                <span class="text-gray-400">Produits</span>
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
                        
                        <!-- WhatsApp Order Button -->
                        <a href="https://wa.me/212779517228?text={{ urlencode('Bonjour, je veux commander les produits suivants :' . PHP_EOL . PHP_EOL . implode(PHP_EOL, $products->pluck('name')->toArray()) . PHP_EOL . PHP_EOL . 'Total: ' . number_format($total, 0) . ' DH') }}" 
                           target="_blank"
                           class="whatsapp-btn w-full py-3 px-4 rounded-full font-semibold flex items-center justify-center gap-2 transition-all">
                            <i class="fab fa-whatsapp text-xl"></i>
                            Commander sur WhatsApp
                        </a>
                        
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

</body>
</html>