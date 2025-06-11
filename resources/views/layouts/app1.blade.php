<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e6eb 100%);
        min-height: 100vh;
        padding: 20px;
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header h1 {
        color: #2d3748;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #ff2d20, #ff5722);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .header p {
        color: #718096;
        font-size: 1.1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .stat-card.en-cours {
        --card-color: #3b82f6;
        /* Bleu pour tâches en cours */
        --card-color-light: #60a5fa;
    }

    .stat-card.terminer {
        --card-color: #10b981;
        /* Vert pour tâches terminées */
        --card-color-light: #34d399;
    }

    .stat-card.en-attente {
        --card-color: #f59e0b;
        /* Orange pour tâches en attente */
        --card-color-light: #fbbf24;
    }

    .stat-card.total {
        --card-color: #ff2d20;
        /* Rouge Laravel pour total */
        --card-color-light: #ff5722;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--card-color);
        margin-bottom: 10px;
        line-height: 1;
    }

    .stat-label {
        color: #718096;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .chart-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .chart-title {
        color: #2d3748;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
    }

    .progress-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .progress-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background: rgba(248, 250, 252, 0.8);
        border-radius: 12px;
    }

    .progress-item:hover {
        transform: translateX(5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .progress-label {
        font-weight: 600;
        color: #374151;
    }

    .progress-bar {
        flex: 1;
        height: 8px;
        background: #e5e7eb;
        border-radius: 4px;
        margin: 0 15px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.8s ease;
    }

    .progress-percentage {
        font-weight: 700;
        color: #374151;
        min-width: 50px;
        text-align: right;
    }


    @media (max-width: 768px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }

        .header h1 {
            font-size: 2rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }
    }

    .animate-in {
        animation: slideInUp 0.6s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <!-- Messages Flash -->
        <div id="flash-messages" class="fixed inset-x-0 top-20 z-50 flex justify-center">
            @if (session('success'))
                <div
                    class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-full max-w-md mx-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="flash-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-full max-w-md mx-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');

            flashMessages.forEach(message => {
                // Afficher avec un léger délai pour le rendu initial
                setTimeout(() => {
                    message.style.display = 'block';

                    // Masquer après 5 secondes
                    setTimeout(() => {
                        message.style.opacity = '1';
                        let fadeEffect = setInterval(() => {
                            if (!message.style.opacity) {
                                message.style.opacity = '1';
                            }
                            if (message.style.opacity > '0') {
                                message.style.opacity = parseFloat(message.style
                                    .opacity) - 0.1;
                            } else {
                                clearInterval(fadeEffect);
                                message.style.display = 'none';
                            }
                        }, 100);
                    }, 5000);
                }, 100);
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Données depuis Laravel
        const taskData = {
            enCours: {{ $taskStats['En cours'] }},
            terminer: {{ $taskStats['Terminer'] }},
            enAttente: {{ $taskStats['En attente'] }}
        };

        const monthlyData = {
            months: @json($monthlyEvolution['months']),
            evolution: @json($monthlyEvolution['data'])
        };

        // Configuration du graphique en secteurs
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['En Cours', 'Terminées', 'En Attente'],
                datasets: [{
                    data: [taskData.enCours, taskData.terminer, taskData.enAttente],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)'
                    ],
                    borderWidth: 3,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    duration: 2000
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
    // Configuration des couleurs
    const colors = {
        terminer: { border: '#10B981', fill: 'rgba(16, 185, 129, 0.1)' },
        enCours: { border: '#3B82F6', fill: 'rgba(59, 130, 246, 0.1)' },
        enAttente: { border: '#F59E0B', fill: 'rgba(245, 158, 11, 0.1)' }
    };

    // Récupération des données
    fetch('/api/stats-data')  // Adaptez cette URL à votre route
        .then(response => response.json())
        .then(data => {
            const monthlyData = data.evolution;
            
            // Création du graphique linéaire
            const ctx = document.getElementById('lineChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: monthlyData.months,
                    datasets: [
                        {
                            label: 'Terminées',
                            data: monthlyData.data['Terminer'],
                            borderColor: colors.terminer.border,
                            backgroundColor: colors.terminer.fill,
                            borderWidth: 3,
                            pointBackgroundColor: colors.terminer.border,
                            pointRadius: 5,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'En Cours',
                            data: monthlyData.data['En cours'],
                            borderColor: colors.enCours.border,
                            backgroundColor: colors.enCours.fill,
                            borderWidth: 3,
                            pointBackgroundColor: colors.enCours.border,
                            pointRadius: 5,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'En Attente',
                            data: monthlyData.data['En attente'],
                            borderColor: colors.enAttente.border,
                            backgroundColor: colors.enAttente.fill,
                            borderWidth: 3,
                            pointBackgroundColor: colors.enAttente.border,
                            pointRadius: 5,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 20,
                                font: {
                                    size: 13,
                                    weight: '600'
                                },
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value % 1 === 0 ? value : '';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
            // Gestion d'erreur à adapter
        });
});
        // Animation des cartes au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-in').forEach(el => {
            observer.observe(el);
        });
    </script>

</body>

</html>
