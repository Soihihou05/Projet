<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tache;
use Illuminate\Support\Facades\Auth;

class TachesFiltrage extends Component
{
    public $q = '';
    public $statut = '';
    public $date_echeance = '';

    public function render()
    {
        $query = Tache::where('user_id', Auth::id());

        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->date_echeance) {
            $query->whereDate('date_echeance', $this->date_echeance);
        }

        if ($this->q) {
            $query->where(function ($q) {
                $q->where('titre', 'like', '%' . $this->q . '%')
                  ->orWhere('description', 'like', '%' . $this->q . '%');
            });
        }

        $taches = $query->orderBy('created_at', 'desc')->get();

        return view('livewire.taches-filtrage', compact('taches'));
    }
}
