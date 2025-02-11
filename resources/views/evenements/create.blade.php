<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-gray-800 text-white border border-yellow-400 shadow-lg rounded-lg p-6">
        <!-- Titre -->
        <h1 class="text-3xl font-bold text-yellow-400 mb-4">Créer une nouvelle quête</h1>

        <!-- Formulaire -->
        <form action="{{ route('evenements.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nom de la quête -->
            <div>
                <label for="nom" class="block font-semibold text-yellow-300">🏹 Nom de la quête</label>
                <input type="text" name="nom" id="nom" required 
                    class="w-full p-2 bg-gray-700 border border-yellow-500 text-white rounded">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block font-semibold text-yellow-300">📜 Description</label>
                <textarea name="description" id="description" required 
                    class="w-full p-2 bg-gray-700 border border-yellow-500 text-white rounded"></textarea>
            </div>

            <!-- Sélectionner le monstre -->
            <div>
                <label for="monstre" class="block font-semibold text-yellow-300">🦖 Monstre</label>
                <select name="monstre" id="monstre" required 
                    class="w-full p-2 bg-gray-700 border border-yellow-500 text-white rounded">
                    <option value="">Sélectionner un monstre</option>
                    @foreach($monsters as $monster)
                        <option value="{{ $monster['name'] }}">{{ $monster['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Récompense -->
            <div>
                <label for="recompense" class="block font-semibold text-yellow-300">💰 Récompense</label>
                <input type="text" name="recompense" id="recompense" required 
                    class="w-full p-2 bg-gray-700 border border-yellow-500 text-white rounded">
            </div>

            <!-- Temps de complétion -->
            <div>
                <label for="temps_completion" class="block font-semibold text-yellow-300">⏳ Temps de complétion (min)</label>
                <input type="number" name="temps_completion" id="temps_completion" value="50" required 
                    class="w-full p-2 bg-gray-700 border border-yellow-500 text-white rounded">
            </div>

            <!-- Bouton de validation -->
            <button type="submit" 
                class="w-full px-4 py-2 bg-green-600 text-white font-bold rounded-lg shadow-lg hover:bg-green-700 transition">
                ⚔️ Créer la quête
            </button>
        </form>

        <!-- Retour -->
        <div class="mt-4">
            <a href="{{ route('evenements.index') }}" class="text-blue-400 hover:text-blue-300 underline">
                ⬅ Retour aux quêtes
            </a>
        </div>
    </div>
</x-app-layout>