<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TacheController;
use App\Models\Tache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('web');
});
// Route::get('home',function(){
//     return view('web');
// });
// Route::resource('taches', TacheController::class)->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('taches.index'); // Redirection vers les tâches
    })->name('dashboard');
    Route::patch('/taches/{tache}/complete', [TacheController::class, 'markAsComplete'])->name('taches.markAsComplete');
    Route::resource('taches', TacheController::class)->parameters([
        'taches' => 'tache'
    ]);
    Route::get('/statistique', [TacheController::class, 'indexstat'])->name('statitique');
    // API pour récupérer les données en JSON (pour mise à jour dynamique)
    Route::get('/api/stats-data', [TacheController::class, 'getStatsData'])->name('dashboard.stats');
    // Route pour supprimer une notification et marquer comme vue
    Route::patch('/notifications/{notif}/read', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/{notif}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
