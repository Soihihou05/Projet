<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord😿') }}
        </h2>
        <br>
        <a href="{{route('taches.create')}}"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition">Ajoutez une
            tâche 😊</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
        @isset($taches)
            @foreach ($taches as $task)
                <div class="border p-4 my-2">
                    <h2 class="text-xl font-bold">{{ $task->titre }}</h2>
                    <p>{{ $task->description }}</p>
                    <p>Statut : {{ $task->statut }}</p>
                    <p>Échéance : {{ $task->date_echeance }}</p>
                </div>
            @endforeach
        @else
            <p class="mt-4">
                <a href="{{route('taches.create')}}"></a>Veuillez ajoutez une taches!
            </p>
        @endisset
    </div>
</x-app-layout>
