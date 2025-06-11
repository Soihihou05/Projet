@extends('layouts.app1')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-container">
                <!-- Header moderne avec ombres et espacement amélioré -->
                <div class="header animate-in bg-white rounded-xl shadow-lg p-8 mb-8 border border-gray-100">
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Statistique des Tâches</h1>
                    <p class="text-lg text-gray-600">Analyse complète de votre productivité et gestion des tâches</p>
                </div>

                <!-- Grille de statistiques avec design carte moderne -->
                <div class="stats-grid mb-8">
                    <!-- Carte En Cours -->
                    <div class="stat-card en-cours animate-in transform transition-all duration-300 hover:scale-105"
                        style="animation-delay: 0.1s">
                        <div class="stat-icon bg-gradient-to-br from-blue-500 to-blue-400 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="stat-number text-blue-600">{{ $taskStats['En cours'] }}</div>
                        <div class="stat-label text-blue-500">En Cours</div>
                    </div>

                    <!-- Carte Terminées -->
                    <div class="stat-card terminer animate-in transform transition-all duration-300 hover:scale-105"
                        style="animation-delay: 0.2s">
                        <div class="stat-icon bg-gradient-to-br from-green-500 to-green-400 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="stat-number text-green-600">{{ $taskStats['Terminer'] }}</div>
                        <div class="stat-label text-green-500">Terminées</div>
                    </div>

                    <!-- Carte En Attente -->
                    <div class="stat-card en-attente animate-in transform transition-all duration-300 hover:scale-105"
                        style="animation-delay: 0.3s">
                        <div class="stat-icon bg-gradient-to-br from-amber-500 to-amber-400 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="stat-number text-amber-600">{{ $taskStats['En attente'] }}</div>
                        <div class="stat-label text-amber-500">En Attente</div>
                    </div>

                    <!-- Carte Total -->
                    <div class="stat-card total animate-in transform transition-all duration-300 hover:scale-105"
                        style="animation-delay: 0.4s">
                        <div class="stat-icon bg-gradient-to-br from-red-500 to-red-400 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="stat-number text-red-600">{{ $taskStats['total'] }}</div>
                        <div class="stat-label text-red-500">Total Tâches</div>
                    </div>
                </div>

                <!-- Grille de graphiques avec design moderne -->
                <div class="charts-grid mb-8">
                    <!-- Graphique circulaire -->
                    <div class="chart-container animate-in bg-white rounded-xl shadow-lg p-6" style="animation-delay: 0.5s">
                        <h3 class="chart-title text-xl font-semibold text-gray-800 mb-6">Répartition des Tâches</h3>
                        <div class="chart-wrapper">
                            <canvas id="pieChart" class="w-full h-64"></canvas>
                        </div>
                    </div>

                    <!-- Graphique linéaire -->
                    <div class="chart-container animate-in bg-white rounded-xl shadow-lg p-6" style="animation-delay: 0.6s">
                        <h3 class="chart-title text-xl font-semibold text-gray-800 mb-6">Évolution Mensuelle</h3>
                        <div class="chart-wrapper">
                            <canvas id="lineChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Section de progression avec design moderne -->
                <div class="progress-section animate-in bg-white rounded-xl shadow-lg p-6" style="animation-delay: 0.7s">
                    <h3 class="chart-title text-xl font-semibold text-gray-800 mb-6">Taux de Completion</h3>

                    <!-- Barre de progression Terminées -->
                    <div class="progress-item bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between w-full">
                            <span class="progress-label font-medium text-gray-700 flex items-center">
                                <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                                Terminées
                            </span>
                            <div class="flex-1 mx-4">
                                <div class="progress-bar bg-gray-200 rounded-full h-2.5">
                                    <div class="progress-fill bg-gradient-to-r from-green-500 to-green-400 rounded-full h-full"
                                        style="width: {{ $taskStats['total'] > 0 ? round(($taskStats['Terminer'] / $taskStats['total']) * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <span class="progress-percentage font-bold text-gray-700">
                                {{ $taskStats['total'] > 0 ? round(($taskStats['Terminer'] / $taskStats['total']) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>

                    <!-- Barre de progression En Cours -->
                    <div class="progress-item bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between w-full">
                            <span class="progress-label font-medium text-gray-700 flex items-center">
                                <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                En Cours
                            </span>
                            <div class="flex-1 mx-4">
                                <div class="progress-bar bg-gray-200 rounded-full h-2.5">
                                    <div class="progress-fill bg-gradient-to-r from-blue-500 to-blue-400 rounded-full h-full"
                                        style="width: {{ $taskStats['total'] > 0 ? round(($taskStats['En cours'] / $taskStats['total']) * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <span class="progress-percentage font-bold text-gray-700">
                                {{ $taskStats['total'] > 0 ? round(($taskStats['En cours'] / $taskStats['total']) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>

                    <!-- Barre de progression En Attente -->
                    <div class="progress-item bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between w-full">
                            <span class="progress-label font-medium text-gray-700 flex items-center">
                                <span class="w-3 h-3 rounded-full bg-amber-500 mr-2"></span>
                                En Attente
                            </span>
                            <div class="flex-1 mx-4">
                                <div class="progress-bar bg-gray-200 rounded-full h-2.5">
                                    <div class="progress-fill bg-gradient-to-r from-amber-500 to-amber-400 rounded-full h-full"
                                        style="width: {{ $taskStats['total'] > 0 ? round(($taskStats['En attente'] / $taskStats['total']) * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <span class="progress-percentage font-bold text-gray-700">
                                {{ $taskStats['total'] > 0 ? round(($taskStats['En attente'] / $taskStats['total']) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
