@extends('admin.layout')

@section('page-title', 'Modifier le Produit')

@section('content')
<div class="max-w-3xl">
    <div class="bg-admin-card rounded-xl border border-admin-border p-6">
        <h2 class="text-xl font-semibold text-white mb-6">Modifier le Produit</h2>
        
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom du produit</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors">
                </div>

                <!-- Prix -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Prix (DH)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors">
                </div>

                <!-- Spécifications -->
                <div>
                    <label for="specs" class="block text-sm font-medium text-gray-300 mb-2">Spécifications</label>
                    <input type="text" name="specs" id="specs" value="{{ old('specs', $product->specs) }}" placeholder="ex: i5 8th | 8/256" required
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description (optionnel)</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors resize-none">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Image Principale Actuelle -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Image principale actuelle</label>
                    <div class="w-32 h-32 rounded-lg overflow-hidden mb-4">
                        <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Nouvelle Image Principale -->
                <div>
                    <label for="img" class="block text-sm font-medium text-gray-300 mb-2">Nouvelle image principale (optionnel)</label>
                    <input type="file" name="img" id="img" accept="image/*"
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-admin-yellow file:text-black hover:file:bg-admin-yellow-hover transition-colors">
                    <p class="mt-2 text-sm text-gray-500">Laissez vide pour conserver l'image actuelle</p>
                </div>

                <!-- Gallery Images Actuelles -->
                @if(count($product->gallery ?? []) > 0)
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Images de la galerie actuelles</label>
                        <div class="flex flex-wrap gap-4 mb-4">
                            @foreach($product->gallery as $image)
                                <div class="w-24 h-24 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery image" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Nouvelle Gallery Images -->
                <div>
                    <label for="gallery" class="block text-sm font-medium text-gray-300 mb-2">Nouvelles images de la galerie (optionnel)</label>
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-admin-yellow file:text-black hover:file:bg-admin-yellow-hover transition-colors">
                    <p class="mt-2 text-sm text-gray-500">Les nouvelles images remplaceront l'ancienne galerie</p>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center space-x-4 mt-8">
                <button type="submit" class="bg-admin-yellow text-black px-6 py-3 rounded-lg font-medium hover:bg-admin-yellow-hover transition-colors">
                    Modifier le produit
                </button>
                <a href="{{ route('admin.products') }}" class="text-gray-400 hover:text-white transition-colors">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection