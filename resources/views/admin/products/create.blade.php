@extends('admin.layout')

@section('page-title', 'Ajouter un Produit')

@section('content')
<div class="max-w-3xl">
    <div class="bg-admin-card rounded-xl border border-admin-border p-6">
        <h2 class="text-xl font-semibold text-white mb-6">Nouveau Produit</h2>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom du produit</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors">
                </div>

                <!-- Prix -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Prix (DH)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors">
                </div>

                <!-- Spécifications -->
                <div>
                    <label for="specs" class="block text-sm font-medium text-gray-300 mb-2">Spécifications</label>
                    <input type="text" name="specs" id="specs" value="{{ old('specs') }}" placeholder="ex: i5 8th | 8/256" required
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description (optionnel)</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-admin-yellow transition-colors resize-none">{{ old('description') }}</textarea>
                </div>

                <!-- Image Principale -->
                <div>
                    <label for="img" class="block text-sm font-medium text-gray-300 mb-2">Image principale</label>
                    <input type="file" name="img" id="img" accept="image/*" required
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-admin-yellow file:text-black hover:file:bg-admin-yellow-hover transition-colors">
                    <p class="mt-2 text-sm text-gray-500">Image principale du produit (max 2MB)</p>
                </div>

                <!-- Gallery Images -->
                <div>
                    <label for="gallery" class="block text-sm font-medium text-gray-300 mb-2">Images de la galerie</label>
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple
                           class="w-full bg-admin-bg border border-admin-border rounded-lg px-4 py-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-admin-yellow file:text-black hover:file:bg-admin-yellow-hover transition-colors">
                    <p class="mt-2 text-sm text-gray-500">Images supplémentaires (maintenez Ctrl pour sélectionner plusieurs images, max 2MB chacune)</p>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center space-x-4 mt-8">
                <button type="submit" class="bg-admin-yellow text-black px-6 py-3 rounded-lg font-medium hover:bg-admin-yellow-hover transition-colors">
                    Créer le produit
                </button>
                <a href="{{ route('admin.products') }}" class="text-gray-400 hover:text-white transition-colors">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection