<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-gray-800 text-white border border-yellow-400 shadow-lg rounded-lg p-6 relative">
        <!-- Titre de la quête -->
        <h1 class="text-3xl font-bold text-yellow-400 mb-4">{{ $evenement->nom }}</h1>
        
        <!-- Description -->
        <p class="italic text-gray-300">{{ $evenement->description }}</p>

        <!-- Détails de la quête -->
        <div class="mt-4 space-y-2">
            <p class="flex items-center">
                <span class="mr-2">🦖</span> <span class="font-semibold">Monstre :</span> {{ $evenement->monstre }}
            </p>
            <p class="flex items-center">
                <span class="mr-2">💰</span> <span class="font-semibold">Récompense :</span> {{ $evenement->recompense }}
            </p>
            <p class="flex items-center">
                <span class="mr-2">⏳</span> <span class="font-semibold">Temps de complétion :</span> {{ $evenement->temps_completion }} min
            </p>
        </div>

        <!-- Boutons d'inscription -->
        @auth
        @hasrole('Chef du village|Chasseur')               
            <div class="mt-6">
                @if(auth()->user()->evenements->contains($evenement->id))
                    <form action="{{ route('evenements.desinscrire', $evenement) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Se désinscrire
                        </button>
                    </form>
                @else
                    <form action="{{ route('evenements.inscrire', $evenement) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            S'inscrire
                        </button>
                    </form>
                @endif
            </div>
        @endhasrole
        @endauth

        <!-- Retour -->
        <div class="mt-4">
            <a href="{{ route('evenements.index') }}" class="text-blue-400 hover:text-blue-300 underline">
                ⬅ Retour aux quêtes
            </a>
        </div>
    </div>
</x-app-layout>