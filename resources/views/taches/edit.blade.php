<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Modifiez la Tâche:</h1>

        <form action="{{ route('taches.update', $tache) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Titre -->
            <div class="mb-4">
                <label for="titre" class="block text-gray-700 font-semibold mb-2">Titre</label>
                <input type="text" name="titre" id="titre"
                    class="w-full border rounded p-2 focus:border-red-500 focus:ring-red-500"
                    value="{{ $tache->titre }}" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" class="w-full border rounded p-2 focus:border-red-500 focus:ring-red-500" rows="4">{{ $tache->description }}</textarea>
            </div>

            <!-- Statut -->
            <div class="mb-4">
                <label for="statut" class="block text-gray-700 font-semibold mb-2">Statut</label>
                <select name="statut" id="statut"
                    class="w-full border rounded p-2 focus:border-red-500 focus:ring-red-500" value="{{$tache->statut}}">
                    <option value="En attente">En attente</option>
                    <option value="En cours">En cours</option>
                    <option value="Terminer">Terminer</option>
                </select>
            </div>

            <!-- Date d'échéance -->
            <div class="mb-4">
                <label for="date_echeance" class="block text-gray-700 font-semibold mb-2">Date d'échéance</label>
                <input type="date" name="date_echeance" id="date_echeance"
                    class="w-full border rounded p-2  focus:border-red-500 focus:ring-red-500"
                    value="{{$tache->date_echeance}}">
            </div>
            <div>
                @error('date_echeance')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton de soumission -->
            <div class="text-right">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">Modifier</button>
                <a href="{{ route('taches.index') }}"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Annuler</a>
            </div>

        </form>
    </div>
</x-app-layout>
