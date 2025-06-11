<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <!-- Titre + Bouton Nouvelle tâche -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 w-full lg:w-auto">
                <div class="space-y-1">
                    <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
                        Tableau de bord <span class="text-indigo-600 animate-pulse">✨</span>
                    </h2>
                    <p class="text-sm text-gray-500 hidden sm:block">Gérez vos tâches efficacement</p>
                </div>

                <a href="{{ route('taches.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-800 hover:from-red-700 hover:to-red-900 text-white font-medium py-2.5 px-5 rounded-full transition-all shadow-lg hover:shadow-xl hover:scale-[1.02]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Nouvelle tâche
                </a>
            </div>

            <!-- Boutons de droite (Stats + Notifications) -->
            <div x-data="{ openNotifications: false }"
                class="flex items-center gap-3 w-full lg:w-auto justify-between sm:justify-end">
                <!-- 🔔 Bouton cloche -->
                <button @click="openNotifications = true"
                    class="relative p-2 rounded-full bg-white shadow border hover:bg-gray-50 transition-colors hover:-translate-y-0.5"
                    title="Notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if ($nonLues > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-white animate-bounce">
                            {{ $nonLues }}
                        </span>
                    @endif
                </button>

                <!-- 📥 Fenêtre des notifications -->
                <div x-show="openNotifications" @click.outside="openNotifications = false" x-cloak
                    class="absolute z-50 top-12 right-0 w-80 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden">
                    <div
                        class="p-4 max-h-64 overflow-y-auto scroll-smooth scrollbar-thin scrollbar-thumb-indigo-300 scrollbar-track-gray-100">
                        <div class="flex items-center justify-between mb-2 relative">
                            <h3 class="font-semibold text-gray-800">Notifications</h3>
                            <button @click="openNotifications = false" class="text-gray-500 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="15" y1="9" x2="9" y2="15" />
                                    <line x1="9" y1="9" x2="15" y2="15" />
                                </svg>
                            </button>
                        </div>

                        @forelse ($notifications as $notif)
                            <div
                                class="p-3 mb-2 rounded flex justify-between items-center {{ $notif->is_read ? 'bg-gray-50 text-gray-700' : 'bg-red-50 text-gray-900 font-semibold' }}">
                                <div class="flex-1">
                                    <p>{{ $notif->message }}</p>
                                </div>

                                <div class="flex space-x-2 ml-3">
                                    <!-- Formulaire pour marquer comme lue/non lue -->
                                    <form action="{{ route('notifications.update', $notif) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="p-1 text-gray-500 hover:text-blue-600 transition-colors"
                                            title="{{ $notif->is_read ? 'Marquer comme non lue' : 'Marquer comme lue' }}">
                                            @if ($notif->is_read)
                                                <!-- Œil ouvert (déjà lu) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            @else
                                                <!-- Œil fermé (non lu) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                                    <line x1="1" y1="1" x2="23" y2="23" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>

                                    <!-- Formulaire pour supprimer la notification -->
                                    <form action="{{ route('notifications.destroy', $notif) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1 text-gray-500 hover:text-red-600 transition-colors"
                                            title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Aucune notification</p>
                        @endforelse
                    </div>
                </div>


                <!-- Bouton Statistiques -->
                <a href="/statistique"
                    class="flex items-center gap-2 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 font-medium py-2.5 px-4 rounded-full transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Statistiques</span>
                </a>
            </div>
        </div>

        <!-- Systeme de filtrage -->
        <div class="mt-6 bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-sm border border-gray-200">
            <form method="GET" action="{{ route('taches.index') }}" class="flex flex-wrap gap-4 items-end">
                <!-- Champ Recherche -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                    <div class="relative">
                        <input type="text" name="q" placeholder="Filtrer les tâches..."
                            value="{{ request('q') }}"
                            class="pl-10 pr-4 py-2 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filtre Statut -->
                <div class="min-w-[180px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="statut"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-lg shadow-sm">
                        <option value="">Tous les statuts</option>
                        <option value="En cours" {{ request('statut') == 'En cours' ? 'selected' : '' }}>En cours
                        </option>
                        <option value="Terminer" {{ request('statut') == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                        <option value="En attente" {{ request('statut') == 'En attente' ? 'selected' : '' }}>En attente
                        </option>
                    </select>
                </div>

                <!-- Filtre Date -->
                <div class="min-w-[180px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Échéance</label>
                    <input type="date" name="date_echeance" value="{{ request('date_echeance') }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                </div>

                <!-- Boutons -->
                <div class="flex gap-2">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Appliquer
                    </button>
                    <a href="{{ route('taches.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </x-slot>

    <!-- Liste des tâches modernisée -->
    <div class="mt-8 space-y-6">
        @forelse ($taches as $task)
            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 hover:border-indigo-200 transition-all duration-200">
                <div class="p-6 flex flex-col sm:flex-row justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3">
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $task->titre }}</h3>
                                    @if ($task->date_echeance)
                                        @php
                                            $isOverdue =
                                                \Carbon\Carbon::parse($task->date_echeance)->isPast() &&
                                                $task->statut !== 'termine';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isOverdue ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ \Carbon\Carbon::parse($task->date_echeance)->format('d/m/Y') }}
                                            @if ($isOverdue)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-3 w-3"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $task->description }}</p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->statut === 'termine' ? 'bg-green-100 text-green-800' : ($task->statut === 'en_cours' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->statut)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-2">
                        {{-- Marquer une tache comme terminer --}}
                        @if ($task->statut !== 'Terminer')
                            <form action="{{ route('taches.markAsComplete', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="js-confetti-btn inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
                                    title="Marquer comme terminée">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        @endif

                        {{-- Modification d'une tache --}}
                        <a href="{{ route('taches.edit', $task) }}"
                            class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            title="Modifier">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>

                        {{-- Supression d'une tache --}}
                        <form action="{{ route('taches.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cette tâche ?')"
                                class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                title="Supprimer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            {{-- si aucune tache n'est trouvée --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Aucune tâche trouvée</h3>
                    <p class="mt-1 text-sm text-gray-500">Commencez par créer une nouvelle tâche</p>
                    <div class="mt-6">
                        <a href="{{ route('taches.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Créer une tâche
                        </a>
                    </div>
                </div>
            </div>
        @endforelse

        <!-- Pagination -->
        @if ($taches->hasPages())
            <div
                class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-b-lg">
                {{ $taches->withQueryString()->links() }}
            </div>
        @endif
    </div>

    @include('includes.Chatbot')
</x-app-layout>
