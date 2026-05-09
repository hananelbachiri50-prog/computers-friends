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

    <!-- Navigation Link -->
    <div class="container mx-auto px-6 py-6">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-yellow-500 transition-colors text-sm font-medium">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
            
            <!-- Left Column: Image Gallery -->
            <div class="space-y-6">
                <!-- Main Image Card -->
                <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-white/5">
                    <img id="mainImage" 
                         src="{{ asset('product/' . $product->img) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-80 md:h-[500px] object-contain mx-auto">
                </div>
                
                <!-- Thumbnails Gallery -->
                @if($product->gallery && count($product->gallery) > 0)
                <div class="flex gap-4 overflow-x-auto pb-2">
                    <!-- Main image thumbnail -->
                    <button onclick="changeImage('{{ asset('product/' . $product->img) }}', this)" 
                            class="gallery-thumb active flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-2xl border-2 border-yellow-500 bg-white p-2 overflow-hidden">
                        <img src="{{ asset('product/' . $product->img) }}" 
                             alt="Main" 
                             class="w-full h-full object-contain">
                    </button>
                    
                    <!-- Gallery thumbnails -->
                    @foreach($product->gallery as $galleryImage)
                    <button onclick="changeImage('{{ asset('product/' . $galleryImage) }}', this)" 
                            class="gallery-thumb flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-2xl border-2 border-zinc-700 bg-white p-2 overflow-hidden hover:border-yellow-500">
                        <img src="{{ asset('product/' . $galleryImage) }}" 
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
                    <button class="btn-glow w-full bg-yellow-500 text-black py-4 px-6 rounded-2xl font-bold text-lg flex items-center justify-center gap-3">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Ajouter au panier</span>
                    </button>
                    
                    <!-- Secondary Actions Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Buy Now Button -->
                        <a href="https://wa.me/212779517228?text=Bonjour, je souhaite commander : {{ urlencode($product->name) }}" 
                           target="_blank"
                           class="btn-glow bg-green-600 text-white py-4 px-6 rounded-2xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-green-500 transition">
                            <i class="fab fa-whatsapp"></i>
                            <span>Acheter</span>
                        </a>
                        
                        <!-- Favorite Button -->
                        <button class="btn-glow bg-zinc-800 text-white py-4 px-6 rounded-2xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-zinc-700 transition border border-zinc-700">
                            <i class="far fa-heart"></i>
                            <span>Favoris</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Image Gallery JavaScript -->
    <script>
        function changeImage(src, thumbnail) {
            const mainImage = document.getElementById('mainImage');
            
            // Fade out, change image, fade in
            mainImage.style.opacity = '0';
            mainImage.style.transform = 'scale(0.98)';
            
            setTimeout(() => {
                mainImage.src = src;
                mainImage.style.opacity = '1';
                mainImage.style.transform = 'scale(1)';
            }, 150);
            
            // Update thumbnail active state
            document.querySelectorAll('.gallery-thumb').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('border-yellow-500');
                btn.classList.add('border-zinc-700');
            });
            
            // Highlight selected thumbnail
            thumbnail.classList.add('active');
            thumbnail.classList.remove('border-zinc-700');
        }
    </script>
</body>
</html>