<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Computer Friends</title>
    
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
        
        /* Input focus animation */
        .input-field {
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            border-color: #FFD700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.15);
            outline: none;
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
<body class="min-h-screen flex items-center justify-center py-12 px-4">

    <!-- Background decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-yellow-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-yellow-500/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Registration Card -->
    <div class="relative z-10 w-full max-w-lg">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <div class="text-3xl font-bold">
                    <span class="text-yellow-500">Computer</span>
                    <span class="text-white">Friends</span>
                </div>
            </a>
            <p class="text-zinc-400 mt-2">Rejoignez-nous pour des offres exclusives</p>
        </div>

        <!-- Form Card -->
        <div class="bg-zinc-900/80 backdrop-blur-xl border border-zinc-800 rounded-3xl p-8 md:p-10 shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">Créer un compte</h2>

            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-400 px-4 py-3 rounded-xl mb-6 text-sm">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-xl mb-6 text-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-zinc-300 mb-2">Nom</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-zinc-500"></i>
                        </div>
                        <input type="text" 
                               name="nom" 
                               id="nom" 
                               value="{{ old('nom') }}"
                               class="input-field w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 pl-12 pr-4 placeholder-zinc-500"
                               placeholder="Votre nom"
                               required>
                    </div>
                </div>

                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-medium text-zinc-300 mb-2">Prénom</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user-circle text-zinc-500"></i>
                        </div>
                        <input type="text" 
                               name="prenom" 
                               id="prenom" 
                               value="{{ old('prenom') }}"
                               class="input-field w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 pl-12 pr-4 placeholder-zinc-500"
                               placeholder="Votre prénom"
                               required>
                    </div>
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-medium text-zinc-300 mb-2">Téléphone</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-zinc-500"></i>
                        </div>
                        <input type="tel" 
                               name="telephone" 
                               id="telephone" 
                               value="{{ old('telephone') }}"
                               class="input-field w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 pl-12 pr-4 placeholder-zinc-500"
                               placeholder="06 XX XX XX XX"
                               required>
                    </div>
                </div>

                <!-- Nom d'utilisateur -->
                <div>
                    <label for="username" class="block text-sm font-medium text-zinc-300 mb-2">Nom d'utilisateur</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-at text-zinc-500"></i>
                        </div>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               value="{{ old('username') }}"
                               class="input-field w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 pl-12 pr-4 placeholder-zinc-500"
                               placeholder="pseudo123"
                               required>
                    </div>
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-300 mb-2">Mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-zinc-500"></i>
                        </div>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="input-field w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 pl-12 pr-4 placeholder-zinc-500"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-300 mb-2">Confirmer le mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-zinc-500"></i>
                        </div>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               class="input-field w-full bg-black/50 border border-zinc-700 text-white rounded-xl py-3 pl-12 pr-4 placeholder-zinc-500"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-glow w-full bg-yellow-500 text-black font-bold py-4 rounded-2xl text-lg flex items-center justify-center gap-2">
                    <span>S'inscrire</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-zinc-400 text-sm">
                    Déjà un compte ? 
                    <a href="{{ route('login') }}" class="text-yellow-500 hover:text-yellow-400 font-medium transition-colors">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-zinc-500 hover:text-zinc-300 text-sm transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
            </a>
        </div>
    </div>

</body>
</html>