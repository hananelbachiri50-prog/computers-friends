@extends('admin.layout')

@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<div class="bg-admin-card rounded-xl border border-admin-border overflow-hidden">
    <div class="px-6 py-4 border-b border-admin-border">
        <h2 class="text-lg font-semibold text-white">Liste des Utilisateurs</h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-admin-sidebar">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Téléphone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Inscrit le</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($users as $user)
                    <tr class="hover:bg-admin-card/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->nom ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->prenom ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->telephone ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($user->active) bg-green-900/30 text-green-400
                                @else bg-red-900/30 text-red-400
                                @endif">
                                {{ $user->active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center space-x-2">
                                @if($user->role !== 'admin')
                                    <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="px-3 py-1 rounded text-xs font-medium transition-colors
                                            @if($user->active) bg-yellow-900/30 text-yellow-400 hover:bg-yellow-900/50
                                            @else bg-green-900/30 text-green-400 hover:bg-green-900/50
                                            @endif">
                                            {{ $user->active ? 'Désactiver' : 'Activer' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 rounded text-xs font-medium bg-red-900/30 text-red-400 hover:bg-red-900/50 transition-colors">
                                            Supprimer
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 text-xs">Admin</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-400">
                            Aucun utilisateur trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="px-6 py-4 border-t border-admin-border">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection