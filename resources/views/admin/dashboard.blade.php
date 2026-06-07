@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-admin-card rounded-xl p-6 border border-admin-border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">Total Utilisateurs</p>
                <p class="text-3xl font-bold text-white">{{ $totalUsers }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-blue-900/30 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-admin-card rounded-xl p-6 border border-admin-border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">Total Produits</p>
                <p class="text-3xl font-bold text-white">{{ $totalProducts }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-green-900/30 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-admin-card rounded-xl p-6 border border-admin-border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">Total Commandes</p>
                <p class="text-3xl font-bold text-white">{{ $totalOrders }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-purple-900/30 flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Most Ordered Product -->
    <div class="bg-admin-card rounded-xl p-6 border border-admin-border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">Produit Populaire</p>
                <p class="text-lg font-bold text-white truncate max-w-[150px]">{{ $mostOrdered ? $mostOrdered->name : 'Aucun' }}</p>
                @if($mostOrdered)
                    <p class="text-sm text-admin-yellow mt-1">{{ $mostOrdered->order_count }} commandes</p>
                @endif
            </div>
            <div class="w-12 h-12 rounded-lg bg-admin-yellow/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-admin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-admin-card rounded-xl border border-admin-border overflow-hidden">
    <div class="px-6 py-4 border-b border-admin-border flex items-center justify-between">
        <h2 class="text-lg font-semibold text-white">Commandes Récentes</h2>
        <a href="{{ route('admin.orders') }}" class="text-sm text-admin-yellow hover:text-admin-yellow-hover">Voir tout</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-admin-sidebar">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Produit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Téléphone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($recentOrders as $order)
                    <tr class="hover:bg-admin-card/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">#{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">{{ $order->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">{{ $order->product->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $order->telephone ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($order->status === 'pending') bg-yellow-900/30 text-yellow-400
                                @elseif($order->status === 'confirmed') bg-blue-900/30 text-blue-400
                                @elseif($order->status === 'shipped') bg-purple-900/30 text-purple-400
                                @elseif($order->status === 'delivered') bg-green-900/30 text-green-400
                                @else bg-red-900/30 text-red-400
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                            Aucune commande récente
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('admin.products.create') }}" class="bg-admin-card rounded-xl p-6 border border-admin-border hover:border-admin-yellow transition-colors group">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 rounded-lg bg-admin-yellow/20 flex items-center justify-center group-hover:bg-admin-yellow/30 transition-colors">
                <svg class="w-6 h-6 text-admin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-white">Ajouter un produit</h3>
                <p class="text-sm text-gray-400">Créer un nouveau produit</p>
            </div>
        </div>
    </a>

    <a href="{{ route('admin.users') }}" class="bg-admin-card rounded-xl p-6 border border-admin-border hover:border-admin-yellow transition-colors group">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 rounded-lg bg-admin-yellow/20 flex items-center justify-center group-hover:bg-admin-yellow/30 transition-colors">
                <svg class="w-6 h-6 text-admin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-white">Gérer les utilisateurs</h3>
                <p class="text-sm text-gray-400">Voir et gérer les comptes</p>
            </div>
        </div>
    </a>
</div>
@endsection