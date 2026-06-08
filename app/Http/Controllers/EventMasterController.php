<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wedding, WeddingTable, Invitation, User}; 
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventMasterController extends Controller
{
    /**
     * Vue principale : Dashboard de pilotage Jour J pour le serveur.
     */
    public function serverDashboard($id)
    {
        $wedding = Wedding::findOrFail($id);

        // Charge les boissons pour le bar
        $wedding->load('drinks');

        // Récupère les invités triés par ordre alphabétique
        $guests = Invitation::where('wedding_id', $wedding->id)
                            ->with('weddingTable')
                            ->orderBy('guest_name', 'asc')
                            ->get();

        // Récupère les tables liées à ce mariage pour le plan de salle
        $tables = WeddingTable::where('wedding_id', $wedding->id)
                                ->with(['invitations']) 
                                ->get();

        return view('server.dashboard', compact('wedding', 'guests', 'tables'));
    }

    /**
     * Validation du pointage via le Scan du QR Code (S'adapte au Superviseur et au Serveur)
     */
    public function checkInQr($token)
    {
        $guest = Invitation::with('weddingTable')->find($token);

        if (!$guest) {
            return redirect()->back()->with('error', "🚨 TICKET INVALIDE : Ce code ne correspond à aucune invitation.");
        }

        if ($guest->is_checked_in == 1) {
            $time = $guest->checked_in_at ? Carbon::parse($guest->checked_in_at)->format('H:i') : 'Inconnue';
            return redirect()->back()->with('error', "⚠️ ALERTE DOUBLON : L'accès pour [{$guest->guest_name}] a DÉJÀ été validé à {$time}.");
        }

        $guest->is_checked_in = 1;
        $guest->checked_in_at = Carbon::now();
        $guest->save();

        $user = Auth::user();
        $message = "✅ SCAN REUSSI • [{$guest->guest_name}] approuvé(e) • Table : " . ($guest->weddingTable ? $guest->weddingTable->name : 'Non placée');

        if ($user && $user->role === 'supervisor') {
            return redirect()->route('supervisor.dashboard', ['id' => $guest->wedding_id])->with('success', $message);
        }

        return redirect()->route('server.dashboard', ['id' => $guest->wedding_id])->with('success', $message);
    }

    /**
     * Dashboard de pilotage Jour J pour le Superviseur.
     */
    public function dashboard($id)
    {
        $wedding = Wedding::findOrFail($id);

        $guests = Invitation::where('wedding_id', $wedding->id)
                            ->orderBy('guest_name', 'asc')
                            ->get();

        $tables = WeddingTable::where('wedding_id', $wedding->id)
                                ->with(['invitations']) 
                                ->get();

        $staff = User::where('wedding_id', $wedding->id)
                     ->whereIn('role', ['server', 'staff', 'maitre'])
                     ->get();

        return view('supervisor.dashboard', compact('guests', 'tables', 'wedding', 'staff'));
    }

    /**
     * Enregistre une nouvelle table de prestige.
     */
    public function storeTable(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $weddingId = null;

        if ($user->role === 'supervisor' || $user->role === 'staff') {
            $weddingId = $user->wedding_id;
        } else {
            $wedding = Wedding::where('user_id', $user->id)->first();
            $weddingId = $wedding ? $wedding->id : null;
        }

        if (!$weddingId) {
            return redirect()->back()->with('error', "Impossible d'identifier le mariage actif.");
        }

        WeddingTable::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'wedding_id' => $weddingId,
        ]);

        return redirect()->back()->with('success', 'Table de prestige ajoutée au plan de salle !');
    }

    /**
     * Validation du Scan QR ou Pointage manuel d'arrivée.
     * RESOLU : Retourne du JSON propre que ce soit en AJAX classique ou avec Fetch API (wantsJson)
     */
    public function checkIn($id)
{
    try {
        $guest = Invitation::with('weddingTable')->findOrFail($id);
        
        // 1. Gestion du doublon
        if ($guest->is_checked_in) {
            return response()->json([
                'success' => false,
                'message' => "⚠️ Déjà validé : {$guest->guest_name} est arrivé à " . Carbon::parse($guest->checked_in_at)->format('H:i')
            ], 400);
        }

        // 2. Mise à jour
        $guest->update([
            'is_checked_in' => true,
            'checked_in_at' => Carbon::now()
        ]);

        // 3. Réponse JSON unifiée (tous les cas de succès retournent un 'message')
        return response()->json([
            'success' => true,
            'message' => "✅ Bienvenue {$guest->guest_name} ! • Table : " . ($guest->weddingTable->name ?? 'Non assignée'),
            'guest_name' => $guest->guest_name,
            'table_name' => $guest->weddingTable->name ?? 'Non assignée'
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => "🚨 Ticket introuvable."
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => "Erreur serveur interne."
        ], 500);
    }
}

    /**
     * Affectation d'une table
     */
    public function assignTable(Request $request)
    {
        try {
            $request->validate([
                'guest_id' => 'required|exists:invitations,id',
                'table_id' => 'nullable'
            ]);

            $invitation = Invitation::findOrFail($request->guest_id);
            $tableId = $request->table_id;

            // Vérification de la capacité de la table si une table est sélectionnée
            if ($tableId) {
                $table = WeddingTable::findOrFail($tableId);
                $currentOccupancy = Invitation::where('wedding_table_id', $table->id)
                                              ->where('id', '!=', $invitation->id)
                                              ->sum('access_count');
                
                if (($currentOccupancy + $invitation->access_count) > $table->capacity) {
                    return response()->json([
                        'success' => false,
                        'message' => "La table {$table->name} n'a pas assez de places disponibles pour ce groupe ({$invitation->access_count} pers.)."
                    ], 422);
                }
            }

            $invitation->wedding_table_id = $tableId ?: null;
            $invitation->save();

            return response()->json([
                'success' => true,
                'message' => 'Table assignée avec succès !'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'assignation : ' . $e->getMessage()
            ], 500);
        }
    }

    public function serveDrinkOnSite(Request $request, $id)
    {
        // 1. Validation de sécurité
        $request->validate([
            'drink_names' => 'required|array',
            'drink_names.*' => 'required|string'
        ]);

        $guest = Invitation::findOrFail($id); 

        // 2. Transformation selon ta structure de base de données
        $guest->preorder_drink = implode(', ', $request->drink_names);
        $guest->save();

        return redirect()->back()->with('success', 'Sélection des boissons enregistrée avec succès !');
    }

    /**
     * Suppression d'une table avec libération automatique des invités.
     */
    public function removeTable($id)
    {
        $table = WeddingTable::findOrFail($id);

        $invitations = Invitation::where('wedding_table_id', $id)->update([
            'wedding_table_id' => null,
            'seat_number' => null
        ]);

        $table->delete();

        return redirect()->back()->with('success', 'Table retirée. Les invités en attente de placement.');
    }

    /**
     * Confirme qu'un invité s'est assis à sa table (via AJAX).
     */
    public function setSeated($id)
    {
        try {
            $guest = Invitation::findOrFail($id);
            $guest->update(['is_seated' => true]);

            return response()->json([
                'success' => true,
                'message' => "L'installation à la table a été validée avec succès."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Erreur lors de la validation : " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Confirme que la boisson de l'invité a été servie (via AJAX).
     */
    public function setServed($id)
    {
        try {
            $guest = Invitation::findOrFail($id);
            $guest->update(['is_served' => true]);

            return response()->json([
                'success' => true,
                'message' => "Le service de la boisson a été validé avec succès."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Erreur lors du service : " . $e->getMessage()
            ], 500);
        }
    }
}