@extends('admin.layout')

@section('page-title', 'Gestion des Commandes')

@section('content')
<div class="bg-admin-card rounded-xl border border-admin-border overflow-hidden">
    <div class="px-6 py-4 border-b border-admin-border">
        <h2 class="text-lg font-semibold text-white">Liste des Commandes</h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-admin-sidebar">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Produit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Téléphone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($orders as $order)
                    <tr class="hover:bg-admin-card/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">#{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">{{ $order->user->name }}</div>
                            @if($order->user->prenom || $order->user->nom)
                                <div class="text-xs text-gray-500">{{ $order->user->prenom }} {{ $order->user->nom }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('storage/' . $order->product->img) }}" alt="{{ $order->product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="text-sm text-white">{{ $order->product->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-admin-yellow font-semibold">{{ number_format($order->product->price, 2) }} DH</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $order->telephone ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($order->status === 'pending') bg-yellow-900/30 text-yellow-400
                                @elseif($order->status === 'confirmed') bg-blue-900/30 text-blue-400
                                @elseif($order->status === 'shipped') bg-purple-900/30 text-purple-400
                                @elseif($order->status === 'delivered') bg-green-900/30 text-green-400
                                @else bg-red-900/30 text-red-400
                                @endif">
                                @if($order->status === 'pending') En attente
                                @elseif($order->status === 'confirmed') Confirmée
                                @elseif($order->status === 'shipped') Expédiée
                                @elseif($order->status === 'delivered') Livrée
                                @else Annulée
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="relative">
                                <select onchange="updateOrderStatus({{ $order->id }}, this.value)" 
                                        class="bg-admin-bg border border-admin-border rounded px-3 py-1 text-sm text-gray-300 focus:outline-none focus:border-admin-yellow">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-400">
                            Aucune commande trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-admin-border">
            {{ $orders->links() }}
        </div>
    @endif
</div>

<script>
function updateOrderStatus(orderId, status) {
    fetch(`/admin/orders/${orderId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection