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

        // 🔥 CORRECTION : On récupère les tables liées à ce mariage pour le plan de salle
        $tables = WeddingTable::where('wedding_id', $wedding->id)
                                ->with(['invitations']) 
                                ->get();

        // 🔥 MODIFICATION : On ajoute 'tables' dans le compact
        return view('server.dashboard', compact('wedding', 'guests', 'tables'));
    }

    /**
     * Validation du pointage via le Scan du QR Code (S'adapte au Superviseur et au Serveur)
     */
    public function checkInQr($token)
    {
        // 1. Trouver l'invité grâce à l'ID lu par le scanner
        $guest = Invitation::with('weddingTable')->find($token);

        // Sécurité 1 : Si l'ID n'existe pas
        if (!$guest) {
            return redirect()->back()->with('error', "🚨 TICKET INVALIDE : Ce code ne correspond à aucune invitation.");
        }

        // Sécurité 2 : Bloquer si le ticket a DÉJÀ été scanné
        if ($guest->is_checked_in == 1) {
            $time = $guest->checked_in_at ? \Illuminate\Support\Carbon::parse($guest->checked_in_at)->format('H:i') : 'Inconnue';
            return redirect()->back()->with('error', "⚠️ ALERTE DOUBLON : L'accès pour [{$guest->guest_name}] a DÉJÀ été validé à {$time}.");
        }

        // 2. SAUVEGARDE FORCEE EN BASE DE DONNEES
        $guest->is_checked_in = 1;
        $guest->checked_in_at = \Illuminate\Support\Carbon::now();
        $guest->save(); // On utilise save() pour être sûr que Laravel pousse immédiatement en DB

        // 3. DETECTION DU PROFILE CONNECTE POUR LA REDIRECTION
        $user = \Illuminate\Support\Facades\Auth::user();
        $message = "✅ SCAN REUSSI • [{$guest->guest_name}] approuvé(e) • Table : " . ($guest->weddingTable ? $guest->weddingTable->name : 'Non placée');

        // Si c'est le superviseur qui scanne sur son moniteur
        if ($user && $user->role === 'supervisor') {
            return redirect()->route('supervisor.dashboard', ['id' => $guest->wedding_id])->with('success', $message);
        }

        // Par défaut (si c'est le serveur ou le staff d'accueil)
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

        // AJOUT : On récupère l'équipe complète liée à ce mariage
        $staff = User::where('wedding_id', $wedding->id)
                     ->whereIn('role', ['server', 'staff', 'maitre'])
                     ->get();

        // MODIFICATION : On ajoute 'staff' dans le compact pour l'envoyer à la vue
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
     */
    public function checkIn($id)
    {
        $guest = Invitation::findOrFail($id);
        
        $guest->update([
            'is_checked_in' => true,
            'checked_in_at' => Carbon::now()
        ]);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'guest_name' => $guest->guest_name,
                'table_name' => $guest->weddingTable ? $guest->weddingTable->name : 'Non assignée'
            ]);
        }

        return redirect()->back()->with('success', "Accès validé pour {$guest->guest_name}. Bienvenue !");
    }

    /**
     * Assignation d'une table à un invité (Sécurisée contre les erreurs 422/500).
     */
    public function assignSeat(Request $request, $id)
    {
        // 1. Récupérer l'invitation
        $guest = Invitation::findOrFail($id);
        
        // 2. Récupérer la valeur brute envoyée par l'AJAX
        $tableId = $request->input('wedding_table_id');

        // 3. Forcer la mise à jour
        $guest->wedding_table_id = $tableId ?: null;
        $guest->save();

        // 4. ÉTAPE DE DIAGNOSTIC : On recharge l'invité depuis la base de données
        $guest->refresh();

        // On renvoie un rapport complet au JavaScript pour voir ce qui est stocké
        return response()->json([
            'success' => true,
            'id_reçu' => $id,
            'table_id_reçu' => $tableId,
            'valeur_sauvegardée_en_db' => $guest->wedding_table_id,
            'est_ce_que_la_table_existe_via_relation' => $guest->weddingTable ? 'Oui : ' . $guest->weddingTable->name : 'Non, la relation renvoie null'
        ]);
    }

    /**
     * Suppression d'une table avec libération automatique des invités.
     */
    public function removeTable($id)
    {
        $table = WeddingTable::findOrFail($id);

        Invitation::where('wedding_table_id', $id)->update([
            'wedding_table_id' => null,
            'seat_number' => null
        ]);

        $table->delete();

        return redirect()->back()->with('success', 'Table retirée. Les invités concernés sont de nouveau en attente de placement.');
    }

    /**
     * 🔥 AJOUT : Confirme qu'un invité s'est assis à sa table (via AJAX).
     */
    public function setSeated($id)
    {
        try {
            $guest = Invitation::findOrFail($id);
            
            $guest->update([
                'is_seated' => true
            ]);

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
     * 🔥 AJOUT : Confirme que la boisson de l'invité a été servie (via AJAX).
     */
    public function setServed($id)
    {
        try {
            $guest = Invitation::findOrFail($id);
            
            $guest->update([
                'is_served' => true
            ]);

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