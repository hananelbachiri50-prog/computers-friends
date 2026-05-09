<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Computer Friends | Premium Store</title>
    
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
        
        /* Hero Slider */
        .hero-slider-container {
            overflow: hidden;
            position: relative;
            border-radius: 16px;
        }
        
        .hero-slider-track {
            display: flex;
            transition: transform 0.8s ease-in-out;
        }
        
        .hero-slider-slide {
            min-width: 100%;
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #111;
        }
        
        .hero-slider-slide img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }
        
        /* Delivery Card */
        .delivery-card {
            transition: all 0.3s ease;
        }
        
        .delivery-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 215, 0, 0.5);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.1);
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
        
        .product-card:hover .add-to-cart {
            background: #fff;
            color: #000;
        }
        
        /* Search Bar */
        .search-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #FFD700;
            outline: none;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
        }
        
        /* Navbar Links */
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #FFD700;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #000;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3);
        }
        
        /* WhatsApp Button */
        .whatsapp-btn {
            background: #25D366;
            transition: all 0.3s ease;
        }
        
        .whatsapp-btn:hover {
            background: #20BA5A;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 211, 102, 0.3);
        }
        
        /* Slider Navigation Dots */
        .slider-dot {
            transition: all 0.3s ease;
        }
        
        .slider-dot.active {
            background: #FFD700;
            width: 24px;
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
        
        ::-webkit-scrollbar-thumb:hover {
            background: #FFA500;
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
                               value="{{ request('search') }}"
                               placeholder="Rechercher un produit (nom, specs)..." 
                               class="search-input w-full py-3 px-5 pr-12 rounded-full text-white placeholder-gray-400">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center hover:bg-yellow-400 transition-colors">
                            <i class="fas fa-search text-black"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Navbar -->
                <nav class="flex items-center gap-4">
                    <a href="{{ route('favorites') }}" class="nav-link text-white hover:text-yellow-500 flex items-center gap-2 relative">
                        <i class="fas fa-heart"></i>
                        <span class="hidden md:inline">Favoris</span>
                        @if(session('favorites') && count(session('favorites')) > 0)
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold">
                            {{ count(session('favorites')) }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('cart') }}" class="nav-link text-white hover:text-yellow-500 flex items-center gap-2 relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hidden md:inline">Panier</span>
                        @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold">
                            {{ count(session('cart')) }}
                        </span>
                        @endif
                    </a>
                    <a href="https://wa.me/212779517228" target="_blank" class="whatsapp-btn text-white py-2 px-4 rounded-full flex items-center gap-2">
                        <i class="fab fa-whatsapp"></i>
                        <span class="hidden md:inline">Need Help</span>
                    </a>
                    <a href="{{ route('login') }}" class="nav-link text-white hover:text-yellow-500">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="hidden md:inline">Connexion</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary py-2 px-5 rounded-full">
                        <span class="hidden md:inline">Inscription</span>
                        <span class="md:hidden"><i class="fas fa-user-plus"></i></span>
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left: Delivery Cards -->
                <div class="lg:col-span-1 flex flex-col gap-4">
                    <!-- Card 1: Livraison -->
                    <div class="delivery-card bg-black border border-yellow-500/20 rounded-2xl p-5 flex items-center gap-4">
                        <div class="w-14 h-14 bg-yellow-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-truck text-yellow-500 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">Livraison rapide</h3>
                            <p class="text-gray-400 text-sm">Partout au Maroc</p>
                        </div>
                    </div>
                    
                    <!-- Card 2: Garantie -->
                    <div class="delivery-card bg-black border border-yellow-500/20 rounded-2xl p-5 flex items-center gap-4">
                        <div class="w-14 h-14 bg-yellow-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-shield-alt text-yellow-500 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">Garantie 3 mois</h3>
                            <p class="text-gray-400 text-sm">Sur tous les produits</p>
                        </div>
                    </div>
                    
                    <!-- Card 3: Qualité -->
                    <div class="delivery-card bg-black border border-yellow-500/20 rounded-2xl p-5 flex items-center gap-4">
                        <div class="w-14 h-14 bg-yellow-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-yellow-500 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">Produits originaux</h3>
                            <p class="text-gray-400 text-sm">Haute qualité garantie</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Slider -->
                <div class="lg:col-span-2">
                    <div class="hero-slider-container" id="heroSlider">
                        <div class="hero-slider-track" id="heroSliderTrack">
                            <!-- Slide 1 -->
                            <div class="hero-slider-slide">
                                <img src="{{ asset('hp-elitebook-745-g5.jpg') }}" alt="HP EliteBook 745 G5">
                            </div>
                            
                            <!-- Slide 2 -->
                            <div class="hero-slider-slide">
                                <img src="{{ asset('Dell-latitude5480.jpg') }}" alt="Dell Latitude 5480">
                            </div>
                            
                            <!-- Slide 3 -->
                            <div class="hero-slider-slide">
                                <img src="{{ asset('hp-elitebook-830-g7.jpg') }}" alt="HP EliteBook 830 G7">
                            </div>
                            
                            <!-- Slide 4 -->
                            <div class="hero-slider-slide">
                                <img src="{{ asset('hpelitebook830g8-tactile-x360.jpg') }}" alt="HP EliteBook 830 G8 x360">
                            </div>
                            
                            <!-- Slide 5 -->
                            <div class="hero-slider-slide">
                                <img src="{{ asset('hp-elitebook-1030-g4-tactile-x360.jpg') }}" alt="HP EliteBook 1030 G4 x360">
                            </div>
                        </div>
                        
                        <!-- Slider Navigation Arrows -->
                        <button onclick="prevHeroSlide()" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/60 hover:bg-yellow-500 text-white rounded-full flex items-center justify-center transition-colors z-10">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </button>
                        <button onclick="nextHeroSlide()" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/60 hover:bg-yellow-500 text-white rounded-full flex items-center justify-center transition-colors z-10">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </button>
                        
                        <!-- Slider Dots -->
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                            <button onclick="goToHeroSlide(0)" class="slider-dot active h-2 w-2 bg-white/50 rounded-full"></button>
                            <button onclick="goToHeroSlide(1)" class="slider-dot h-2 w-2 bg-white/50 rounded-full"></button>
                            <button onclick="goToHeroSlide(2)" class="slider-dot h-2 w-2 bg-white/50 rounded-full"></button>
                            <button onclick="goToHeroSlide(3)" class="slider-dot h-2 w-2 bg-white/50 rounded-full"></button>
                            <button onclick="goToHeroSlide(4)" class="slider-dot h-2 w-2 bg-white/50 rounded-full"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCTS SECTION -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Section Title -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">
                    <span class="text-yellow-500">Nos</span> Produits
                </h2>
                <div class="w-24 h-1 bg-yellow-500 mx-auto rounded-full"></div>
                <p class="text-gray-400 mt-4">Découvrez notre sélection d'ordinateurs de qualité professionnelle</p>
            </div>
            
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="product-card bg-cf-gray rounded-2xl overflow-hidden border border-gray-800">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden group">
                        <a href="{{ route('product.show', $product->id) }}">
                            <img src="{{ asset('product/' . $product->img) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-48 object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                        </a>
                        <div class="absolute top-3 right-3">
                            <form action="{{ route('favorites.toggle', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="w-10 h-10 rounded-full flex items-center justify-center transition-all {{ in_array($product->id, $favorites ?? []) ? 'bg-yellow-500 text-black' : 'bg-black/50 text-white hover:bg-yellow-500 hover:text-black' }}">
                                    <i class="{{ in_array($product->id, $favorites ?? []) ? 'fas' : 'far' }} fa-heart"></i>
                                </button>
                            </form>
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
                            <button class="add-to-cart bg-yellow-500 text-black px-4 py-2 rounded-full font-semibold text-sm hover:bg-white transition-colors">
                                <i class="fas fa-cart-plus mr-2"></i>Ajouter
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="border-2 border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-black px-8 py-3 rounded-full font-semibold transition-all duration-300">
                    Voir plus de produits
                </button>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Notification Popup -->
    <div id="cartNotification" class="fixed inset-0 z-[100] hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm transition-opacity opacity-0" id="notificationBackdrop"></div>
        
        <!-- Popup -->
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-[#1a1a1a] border border-yellow-500/30 rounded-3xl p-8 max-w-md w-full shadow-2xl transform scale-90 opacity-0 transition-all duration-300" id="notificationPopup">
                <!-- Success Icon -->
                <div class="text-center mb-6">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <i class="fas fa-check text-black text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Produit ajouté au panier !</h3>
                    <p class="text-gray-400" id="notificationProductName"></p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('cart') }}" class="w-full py-3 px-6 bg-gradient-to-r from-yellow-400 to-yellow-500 text-black font-semibold rounded-full text-center hover:shadow-lg hover:shadow-yellow-500/30 transition-all duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>Voir le panier
                    </a>
                    <a href="https://wa.me/212779517228" target="_blank" class="w-full py-3 px-6 bg-green-500 text-white font-semibold rounded-full text-center hover:bg-green-600 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fab fa-whatsapp text-xl"></i>Commander
                    </a>
                    <button onclick="closeNotification()" class="w-full py-2 px-6 text-gray-400 hover:text-white transition-colors">
                        Continuer les achats
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Slider JavaScript -->
    <script>
        let currentHeroSlide = 0;
        const totalHeroSlides = 5;
        const heroSliderTrack = document.getElementById('heroSliderTrack');
        const heroDots = document.querySelectorAll('#heroSlider .slider-dot');
        let heroAutoSlideInterval;
        
        function updateHeroSlider() {
            heroSliderTrack.style.transform = `translateX(-${currentHeroSlide * 100}%)`;
            
            // Update dots
            heroDots.forEach((dot, index) => {
                if (index === currentHeroSlide) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
        
        function nextHeroSlide() {
            currentHeroSlide = (currentHeroSlide + 1) % totalHeroSlides;
            updateHeroSlider();
        }
        
        function prevHeroSlide() {
            currentHeroSlide = (currentHeroSlide - 1 + totalHeroSlides) % totalHeroSlides;
            updateHeroSlider();
        }
        
        function goToHeroSlide(index) {
            currentHeroSlide = index;
            updateHeroSlider();
        }
        
        // Auto slide
        function startHeroAutoSlide() {
            heroAutoSlideInterval = setInterval(nextHeroSlide, 4000);
        }
        
        function stopHeroAutoSlide() {
            clearInterval(heroAutoSlideInterval);
        }
        
        // Start auto-slide on page load
        startHeroAutoSlide();
        
        // Pause on hover
        document.getElementById('heroSlider').addEventListener('mouseenter', stopHeroAutoSlide);
        document.getElementById('heroSlider').addEventListener('mouseleave', startHeroAutoSlide);
        
        // Cart Notification System
        function openNotification(productName) {
            const notification = document.getElementById('cartNotification');
            const backdrop = document.getElementById('notificationBackdrop');
            const popup = document.getElementById('notificationPopup');
            const productNameEl = document.getElementById('notificationProductName');
            
            productNameEl.textContent = productName;
            notification.classList.remove('hidden');
            
            // Trigger animation
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                popup.classList.remove('scale-90', 'opacity-0');
                popup.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        
        function closeNotification() {
            const notification = document.getElementById('cartNotification');
            const backdrop = document.getElementById('notificationBackdrop');
            const popup = document.getElementById('notificationPopup');
            
            backdrop.classList.add('opacity-0');
            popup.classList.remove('scale-100', 'opacity-100');
            popup.classList.add('scale-90', 'opacity-0');
            
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 300);
        }
        
        // Add to Cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const productCard = this.closest('.product-card');
                const productName = productCard.querySelector('h3').textContent;
                const productId = productCard.querySelector('a[href*="product"]').href.split('/').pop();
                
                // Add animation to button
                this.classList.add('scale-95');
                setTimeout(() => this.classList.remove('scale-95'), 150);
                
                // Send AJAX request to add to cart
                fetch('/cart/add/' + productId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update or create cart badge in navbar
                        const cartLink = document.querySelector('a[href="/cart"]');
                        if (cartLink) {
                            let badge = cartLink.querySelector('.cart-badge');
                            if (!badge) {
                                badge = document.createElement('span');
                                badge.className = 'absolute -top-2 -right-2 w-5 h-5 bg-yellow-500 text-black text-xs rounded-full flex items-center justify-center font-bold cart-badge';
                                cartLink.appendChild(badge);
                            }
                            badge.textContent = data.cartCount;
                        }
                        
                        // Show notification
                        openNotification(productName);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
        
        // Close notification when clicking backdrop
        document.getElementById('notificationBackdrop').addEventListener('click', closeNotification);
        
        // Close notification on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeNotification();
            }
        });
    </script>
</body>
</html>