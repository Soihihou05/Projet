<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Tache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class NotificationTacheService
{
    public static function verifierEtNotifierTache(Tache $tache): void
    {
        // 1. Pas de date ou tâche terminée ? On supprime les notifs existantes et on sort
        if (!$tache->date_echeance || $tache->statut === 'Terminer') {
            Notification::where('tache_id', $tache->id)->delete();
            return;
        }

        // 2. Calculer les jours restants
        $daysLeft = Carbon::parse($tache->date_echeance)->diffInDays(now(), false);

        // 3. Vérifier si une notification existe déjà pour cette tâche
        $notif = Notification::where('user_id', Auth::id())
            ->where('tache_id', $tache->id)
            ->first();

        // Si la date est dans le futur mais au-delà de 2 jours, on supprime la notif existante
        if ($daysLeft < -2) {
            if ($notif) {
                $notif->delete();
            }
            return;
        }

        // Si la date est passée de plus de 2 jours, on supprime la notif existante
        if ($daysLeft > 2) {
            if ($notif) {
                $notif->delete();
            }
            return;
        }

        $nouveauMessage = '⏳ La tâche "' . $tache->titre . '" approche de sa date limite (' . $tache->date_echeance . ')';

        // 4. Si notification existe, on met toujours à jour le message et la date
        if ($notif) {
            $notif->update([
                'message' => $nouveauMessage,
                // 'is_read' => false, // remet à non lu si mise à jour
            ]);
        } else {
            // 5. Sinon, création
            Notification::create([
                'user_id' => Auth::id(),
                'tache_id' => $tache->id,
                'message' => $nouveauMessage,
                'is_read' => false,
            ]);
        }
    }
}
