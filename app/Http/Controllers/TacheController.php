<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\NotificationTacheService;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tache::where('user_id', Auth::id());

        // Filtrage par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtrage par date d’échéance
        if ($request->filled('date_echeance')) {
            $query->whereDate('date_echeance', $request->date_echeance);
        }

        //Recherche par mot-clé (dans le titre)
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->q . '%');
            });
        }

        $taches = $query->orderBy('created_at', 'desc')->paginate(5);


        // 2. Création automatique de notifications pour tâches proches de l'échéance
        foreach ($taches as $tache) {
            NotificationTacheService::verifierEtNotifierTache($tache);
        }





        // 3. Récupérer les notifications
        $notifications = Notification::where('user_id', Auth::id())->latest()->get();
        $nonLues = Notification::where('user_id', Auth::id())->where('is_read', false)->count();

        return view('taches.index', compact('taches', 'notifications', 'nonLues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:En cours,Terminer,En attente',
            'date_echeance' => 'nullable|date|after_or_equal:today',
        ], [
            'date_echeance.after_or_equal' => 'La date d\'échéance ne peut pas être dans le passé.',
        ]);

        Tache::create([
            'user_id' => Auth::id(), // Relier à l'utilisateur connecté
            'titre' => $request->titre,
            'description' => $request->description,
            'statut' => $request->statut,
            'date_echeance' => $request->date_echeance,
        ]);
        return redirect()->route('taches.index')->with('success', 'Tâche crée avec succés!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tache $tache)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tache $tache)
    {
        return view('taches.edit', compact('tache'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tache $tache)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:En cours,Terminer,En attente',
            'date_echeance' => 'nullable|date|after_or_equal:today',
        ], [
            'date_echeance.after_or_equal' => 'La date d\'échéance ne peut pas être dans le passé.',
        ]);
        $tache->update($request->all());
        NotificationTacheService::verifierEtNotifierTache($tache);
        return redirect()->route('taches.index')->with('success', 'Tâche mise à jour avec succès.');
    }
    /**
     * Marquer la tache comme terminer
     */
    public function markAsComplete(Tache $tache)
    {
        if (Auth::id() !== $tache->user_id) {
            abort(403, 'Action non autorisée');
        }

        $tache->update(['statut' => 'Terminer']);

        return redirect()->route('taches.index')->with('success', 'Tâche marquée comme terminée !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tache $tache)
    {
        $tache->delete();
        return redirect()->route('taches.index');
    }
    /**
     * Dasboard des statistiques
     */
    public function indexstat()
    {
        $user = Auth::user();

        // Récupérer les statistiques des tâches de l'utilisateur connecté
        $taskStats = $this->getTaskStatistics($user->id);

        // Récupérer l'évolution mensuelle
        $monthlyEvolution = $this->getMonthlyEvolution($user->id);

        return view('dashboard.index', compact('taskStats', 'monthlyEvolution'));
    }

    /**
     * Récupérer les statistiques des tâches par statut
     */
    private function getTaskStatistics($userId)
    {
        $stats = DB::table('taches')
            ->select('statut', DB::raw('count(*) as count'))
            ->where('user_id', $userId)
            ->groupBy('statut')
            ->pluck('count', 'statut')
            ->toArray();

        return [
            'En cours' => $stats['En cours'] ?? 0,
            'Terminer' => $stats['Terminer'] ?? 0,
            'En attente' => $stats['En attente'] ?? 0,
            'total' => array_sum($stats)
        ];
    }

    /**
     * Récupérer l'évolution mensuelle des tâches (6 derniers mois)
     */
    private function getMonthlyEvolution($userId)
    {
        $months = [];
        $evolution = [
            'En cours' => [],
            'Terminer' => [],
            'En attente' => []
        ];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('M');
            $months[] = $monthName;

            // Compter les tâches créées ce mois-là par statut
            $monthlyStats = DB::table('taches')
                ->select('statut', DB::raw('count(*) as count'))
                ->where('user_id', $userId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->groupBy('statut')
                ->pluck('count', 'statut')
                ->toArray();

            $evolution['En cours'][] = $monthlyStats['En cours'] ?? 0;
            $evolution['Terminer'][] = $monthlyStats['Terminer'] ?? 0;
            $evolution['En attente'][] = $monthlyStats['En attente'] ?? 0;
        }

        return [
            'months' => $months,
            'data' => $evolution
        ];
    }

    /**
     * API pour récupérer les données en JSON (pour AJAX)
     */
    public function getStatsData()
    {
        $user = Auth::user();
        $taskStats = $this->getTaskStatistics($user->id);
        $monthlyEvolution = $this->getMonthlyEvolution($user->id);

        return response()->json([
            'stats' => $taskStats,
            'evolution' => $monthlyEvolution
        ]);
    }
}
