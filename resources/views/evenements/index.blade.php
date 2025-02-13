<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quêtes disponibles') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($evenements as $evenement)
                <div class="bg-gray-800 text-white border border-yellow-400 shadow-lg rounded-lg p-6 relative">
                    <!-- Titre de la quête -->
                    <h2 class="text-2xl font-bold text-yellow-400 mb-2">{{ $evenement->nom }}</h2>
                    
                    <!-- Monstre -->
                    <p class="flex items-center">
                        <span class="mr-2">🦖</span> <span class="font-semibold">Monstre :</span> {{ $evenement->monstre }}
                    </p>

                    <!-- Récompense -->
                    <p class="flex items-center">
                        <span class="mr-2">💰</span> <span class="font-semibold">Récompense :</span> {{ $evenement->recompense }}
                    </p>

                    <!-- Temps de complétion -->
                    <p class="flex items-center">
                        <span class="mr-2">⏳</span> <span class="font-semibold">Temps :</span> {{ $evenement->temps_completion }} min
                    </p>

                    <!-- Nombre de participants -->
                    <p class="flex items-center mt-2">
                        <span class="mr-2">👥</span> <span class="font-semibold">Participants :</span> {{ $evenement->chasseurs->count() }}
                    </p>

                    <!-- Boutons -->
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('evenements.show', $evenement) }}" 
                           class="text-blue-400 hover:text-blue-300 underline">
                            Voir les détails
                        </a>

                        @auth
                        @hasrole('Chef du village|Chasseur')
                            @if(auth()->user()->evenements->contains($evenement->id))
                                <form action="{{ route('evenements.desinscrire', $evenement) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Se désinscrire
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('evenements.inscrire', $evenement) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                        S'inscrire
                                    </button>
                                </form>
                            @endif
                        @endhasrole
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>