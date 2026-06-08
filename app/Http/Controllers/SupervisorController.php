<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Wedding, Invitation};
use Illuminate\Support\Facades\{Hash, Auth};

class SupervisorController extends Controller
{
    /**
     * Obtenir le mariage lié à l'utilisateur connecté (Marié ou Staff).
     * Centralisé pour éviter les répétitions et les bugs d'ID.
     */
    private function getActiveWedding()
    {
        // 1. On cherche si l'utilisateur connecté est le marié (propriétaire) ET on charge les boissons
        $wedding = Wedding::with('drinks')->where('user_id', Auth::id())->first();

        // 2. Si non, on cherche via le wedding_id présent sur son compte staff ET on charge aussi les boissons
        if (!$wedding && Auth::user()->wedding_id) {
            $wedding = Wedding::with('drinks')->find(Auth::user()->wedding_id);
        }

        return $wedding;
    }

    /**
     * ESPACE MARIÉ : Affiche l'effectif complet de l'équipe.
     */
    public function index()
    {
        $wedding = $this->getActiveWedding();

        if (!$wedding) {
            return view('client.staff.index', ['staff' => collect(), 'wedding' => null])
                   ->with('error', 'Aucun mariage associé à votre compte.');
        }

        // Le marié voit TOUS les rôles du staff sans exception
        $staff = User::where('wedding_id', $wedding->id)
                     ->whereIn('role', ['supervisor', 'server', 'staff', 'maitre'])
                     ->get();
        
        return view('client.staff.index', compact('staff', 'wedding'));
    }

    /**
     * Enregistre un nouveau membre du staff.
     */
    public function store(Request $request)
    {
        // 1. Récupération du mariage actif avant tout pour la validation
        $wedding = $this->getActiveWedding();

        if (!$wedding) {
            return redirect()->back()->with('error', 'Action impossible : Aucun mariage actif trouvé pour votre compte.');
        }

        // 2. Validation stricte et dynamique (L'email doit être unique UNIQUEMENT pour CE mariage)
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required',
            'role'  => 'required|in:supervisor,server,staff,maitre',
            'email' => [
                'required',
                'email',
                // Cette règle vérifie l'unicité de l'email mais uniquement pour le wedding_id actuel
                \Illuminate\Validation\Rule::unique('users', 'email')->where(function ($query) use ($wedding) {
                    return $query->where('wedding_id', $wedding->id);
                })
            ],
        ], [
            'email.unique' => 'Ce collaborateur (email) est déjà inscrit dans l\'équipe de ce mariage.',
        ]);

        // 3. Génération automatique des identifiants temporaires
        $firstName = explode(' ', trim($request->name))[0];
        $simplePass = strtolower($firstName) . rand(100, 999); 

        try {
            // 4. Création de l'utilisateur Staff
            User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'role'       => $request->role, 
                'wedding_id' => $wedding->id,
                'password'   => Hash::make($simplePass),
            ]);

            // 5. AJUSTEMENT : Préparation de la redirection WhatsApp (Lien Isolé)
            $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
            
            // On force un slash à la fin pour aider l'analyse de l'adresse IP par WhatsApp
            $loginUrl = url('/login') . '/'; 

            $waText = "Bonjour {$request->name}, vos accès Staff WedDream :\n\n" .
                      "📧 Email : {$request->email}\n" .
                      "🔑 Code : {$simplePass}\n\n" .
                      "🔗 Lien de connexion :\n" .
                      "{$loginUrl}";

            $waUrl = "https://wa.me/{$cleanPhone}?text=" . urlencode($waText);

            return redirect()->back()->with([
                'success' => 'Membre du staff ajouté avec succès !', 
                'waUrl'   => $waUrl
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    /**
     * Supprime un membre du staff.
     */
    public function destroy($id)
    {
        $member = User::findOrFail($id);
        $member->delete();

        return redirect()->back()->with('success', 'Collaborateur retiré.');
    }

    /**
     * Réinitialise le mot de passe et génère un nouveau lien de notification.
     */
    public function resetPassword($id)
    {
        $member = User::findOrFail($id);
        
        // Sécurité au cas où le nom soit vide ou sans espace
        $firstName = head(explode(' ', trim($member->name))) ?: 'staff';
        $newPass = strtolower($firstName) . rand(100, 999);
        
        // Mise à jour sécurisée en BDD
        $member->update(['password' => Hash::make($newPass)]);

        // Nettoyage du téléphone
        $phone = preg_replace('/[^0-9]/', '', $member->phone);
        
        // On force un slash de fermeture pour l'adresse de base du site
        $siteUrl = url('/') . '/';
        
        // AJUSTEMENT : Message WhatsApp personnalisé avec lien isolé
        $message = "✨ *Rappel Accès Staff WedDream* ✨\n\n" .
                   "Bonjour " . $member->name . ",\n" .
                   "Voici tes nouveaux identifiants :\n" .
                   "📧 *Email* : " . $member->email . "\n" .
                   "🔑 *Nouveau Mot de passe* : " . $newPass . "\n\n" .
                   "🔗 *Lien de connexion* :\n" .
                   "{$siteUrl}\n\n" .
                   "Connecte-toi vite pour vérifier !";

        $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        // On passe l'URL à la session flash pour que Blade puisse l'attraper
        return redirect()->back()->with([
            'success' => 'Mot de passe mis à jour avec succès !',
            'waUrl' => $waUrl
        ]);
    }    

    /**
     * GÉNÈRE LA PAGE D'IMPRESSION DU CODE QR POUR LA BORNE D'ACCUEIL D'UN MARIAGE
     */
    public function generateBorneQr($id)
    {
        // On récupère le mariage actuel de l'utilisateur connecté pour sécuriser l'accès
        $wedding = $this->getActiveWedding();

        if (!$wedding || $wedding->id != $id) {
            abort(403, 'Action non autorisée pour ce mariage.');
        }

        // Clé unique et sécurisée combinée avec l'ID du mariage actuel
        $borneValue = "WEDDING_BORNE_VALID_" . $wedding->id;

        // Retourne la vue placée dans ton dossier client/staff
        return view('client.staff.borne-qr', compact('wedding', 'borneValue'));
    }
    public function printTableTicket($id)
{
    $wedding = $this->getActiveWedding();

    if (!$wedding) {
        abort(403, 'Aucun mariage actif trouvé.');
    }

    // 1. On récupère la table via le bon modèle 'WeddingTable'
    $table = \App\Models\WeddingTable::findOrFail($id);

    // 2. On extrait son vrai nom configuré par le marié
    $tableName = $table->name; 

    // 3. On garde les boissons du mariage actuel
    $drinks = $wedding->drinks; 

    return view('client.staff.print-ticket', compact('wedding', 'drinks', 'tableName'));
}

}