<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Notification $notif)
    {
        if (Auth::id() !== $notif->user_id) {
            abort(403, 'Action non autorisée');
        }
        $notif->update(['is_read' => !$notif->is_read]);
        
        return back()->with('success', 'Statut de notification mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notif)
    {
        //
        $notif->delete();
        
        return back()->with('success', 'Notification supprimée');
    }
}
