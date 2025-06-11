<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Créer une nouvelle tâche</h1>

        <form action="{{ route('taches.store') }}" method="POST">
            @csrf

            <!-- Titre -->
            <div class="mb-4">
                <label for="titre" class="block text-gray-700 font-semibold mb-2">Titre</label>
                <input type="text" name="titre" id="titre" value="{{ old('titre', $tache->titre ?? '') }}"
                    class="w-full border rounded p-2 focus:border-red-500 focus:ring-red-300" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" class="w-full border rounded p-2 focus:border-red-500 focus:ring-red-300"
                    rows="4"></textarea>
            </div>

            <!-- Statut -->
            <div class="mb-4">
                <label for="statut" class="block text-gray-700 font-semibold mb-2">Statut</label>
                <select name="statut" id="statut"
                    class="w-full border rounded p-2 focus:border-red-500 focus:ring-red-300">
                    <option value="En attente">En attente</option>
                    <option value="En cours">En cours</option>
                    <option value="Terminer">Terminer</option>
                </select>
            </div>

            <!-- Date d'échéance -->
            <div class="mb-4">
                <label for="date_echeance" class="block text-gray-700 font-semibold mb-2">Date d'échéance</label>
                <input type="date" name="date_echeance" id="date_echeance" min="{{ date('d-m-Y') }}"
                    value="{{ old('date_echeance', $tache->date_echeance ?? '') }}"
                    class="w-full border rounded p-2  focus:border-red-500 focus:ring-red-300">
            </div>
            <div>
                @error('date_echeance')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton de soumission -->
            <div class="text-right">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">Créer</button>
                <a href="{{ route('taches.index') }}"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Annuler</a>
            </div>

        </form>
    </div>
</x-app-layout>
