<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;
use Illuminate\Support\Facades\Auth;
use App\Models\WeddingDrink; // CORRECTION : On utilise ton vrai modèle existant !
// Si la table s'attend à recevoir la classe Invitation, assure-toi qu'elle soit importée si besoin :
// use App\Models\Invitation; 

class WeddingController extends Controller
{
    /**
     * Affiche le tableau de bord principal pour le marié connecté.
     * Cette page sert de centre de contrôle pour gérer les invités,
     * l'équipe (superviseurs/serveurs) et les détails du mariage.
     */
    public function show() 
    {
        // On récupère le mariage lié à l'utilisateur connecté
        $wedding = Wedding::where('user_id', Auth::id())->first();

        // Si aucun mariage n'est trouvé, on peut rediriger ou afficher une vue d'attente
        if (!$wedding) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Aucun mariage n’est associé à votre compte. Contactez l’administrateur.');
        }
        
        return view('client.dashboard', compact('wedding'));
    }

    /**
     * Enregistre la boisson envoyée depuis le dashboard du superviseur
     */
    public function storeDrink(Request $request, $weddingId)
    {
        // 1. Sécurité : On s'assure que le mariage existe
        $wedding = Wedding::findOrFail($weddingId);

        // 2. Validation stricte du nom et de la catégorie envoyés par le formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255'
        ]);

        // 3. Écriture sécurisée et explicite dans ta vraie table
        $drink = new WeddingDrink();
        $drink->wedding_id = $wedding->id;
        $drink->name = $request->name;
        $drink->category = $request->category;
        
        // On sauvegarde et on intercepte directement les pannes
        if ($drink->save()) {
            return redirect()->back()->with('success', 'Boisson ajoutée à la carte du mariage !');
        }

        return redirect()->back()->with('error', 'Impossible d\'enregistrer la boisson.');
    }

    /**
     * Index du Dashboard Superviseur (Chargé d'afficher la page avec les listes)
     */
    public function index($weddingId)
    {
        // On récupère le mariage ET on charge la relation "drinks" (qui appelle WeddingDrink)
        $wedding = Wedding::with('drinks')->findOrFail($weddingId);
        
        // On récupère le reste de tes données
        $guests = $wedding->guests; // s'assurer que la relation "guests" existe dans Wedding
        $tables = $wedding->tables; // s'assurer que la relation "tables" existe dans Wedding

        // On passe toutes les variables nécessaires au bon fonctionnement de ton Blade
        return view('supervisor.dashboard', compact('wedding', 'guests', 'tables'));
    }

    /**
     * Statistiques optionnelles des boissons choisies par les invités
     */
    public function showDashboard($weddingId)
    {
        $wedding = Wedding::findOrFail($weddingId);

        // Récupérer les invités qui viennent et voir leurs choix
        // Remplace par \App\Models\Invitation si le modèle n'est pas importé en haut
        $guestsChoices = \App\Models\Invitation::where('wedding_id', $weddingId)
                            ->where('rsvp_status', 'confirme')
                            ->select('guest_name', 'preorder_drink') 
                            ->get();

        // Faire un état des lieux / total par boisson pour le barman
        $drinksStats = \App\Models\Invitation::where('wedding_id', $weddingId)
                            ->where('rsvp_status', 'confirme')
                            ->groupBy('preorder_drink')
                            ->selectRaw('preorder_drink, count(*) as total')
                            ->get();

        return view('supervisor.dashboard', compact('wedding', 'guestsChoices', 'drinksStats'));
    }
}