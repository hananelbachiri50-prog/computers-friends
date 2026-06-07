@extends('admin.layout')

@section('page-title', 'Gestion des Produits')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-semibold text-white">Liste des Produits</h2>
    <a href="{{ route('admin.products.create') }}" class="bg-admin-yellow text-black px-4 py-2 rounded-lg font-medium hover:bg-admin-yellow-hover transition-colors flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Ajouter un produit</span>
    </a>
</div>

<div class="bg-admin-card rounded-xl border border-admin-border overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-admin-sidebar">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Spécifications</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Gallery</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($products as $product)
                    <tr class="hover:bg-admin-card/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-16 h-16 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->specs }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-admin-yellow font-semibold">{{ number_format($product->price, 2) }} DH</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            {{ count($product->gallery ?? []) }} image(s)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="px-3 py-1 rounded text-xs font-medium bg-blue-900/30 text-blue-400 hover:bg-blue-900/50 transition-colors">
                                    Modifier
                                </a>
                                <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 rounded text-xs font-medium bg-red-900/30 text-red-400 hover:bg-red-900/50 transition-colors">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                            Aucun produit trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="px-6 py-4 border-t border-admin-border">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection