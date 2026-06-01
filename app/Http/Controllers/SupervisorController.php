<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Wedding};
use Illuminate\Support\Facades\{Hash, Auth};

class SupervisorController extends Controller
{
    /**
     * Obtenir le mariage lié à l'utilisateur connecté (Marié ou Staff).
     * Centralisé pour éviter les répétitions et les bugs d'ID.
     */
    private function getActiveWedding()
    {
        // 1. On regarde si l'utilisateur connecté est le marié (propriétaire)
        $wedding = Wedding::where('user_id', Auth::id())->first();

        // 2. Si non, on cherche via le wedding_id présent sur son compte staff
        if (!$wedding && Auth::user()->wedding_id) {
            $wedding = Wedding::find(Auth::user()->wedding_id);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'role' => 'required|in:supervisor,server,staff,maitre',
        ]);

        $wedding = $this->getActiveWedding();

        if (!$wedding) {
            return redirect()->back()->with('error', 'Action impossible : Aucun mariage actif trouvé pour votre compte.');
        }
        
        $firstName = explode(' ', $request->name)[0];
        $simplePass = strtolower($firstName) . rand(100, 999); 

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role, 
                'wedding_id' => $wedding->id,
                'password' => Hash::make($simplePass),
            ]);

            $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
            $waText = "Bonjour {$request->name}, vos accès Staff WedDream :\nEmail: {$request->email}\nCode: {$simplePass}";
            $waUrl = "https://wa.me/{$cleanPhone}?text=" . urlencode($waText);

            return redirect()->back()->with(['success' => 'Staff ajouté avec succès !', 'waUrl' => $waUrl]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
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
    
    // Ton message WhatsApp personnalisé
    $message = "✨ *Rappel Accès Staff WedDream* ✨\n\n" .
               "Bonjour " . $member->name . ",\n" .
               "Voici tes nouveaux identifiants :\n" .
               "📧 *Email* : " . $member->email . "\n" .
               "🔑 *Nouveau Mot de passe* : " . $newPass . "\n" .
               "🔗 *Lien* : " . url('/') . "\n\n" .
               "Connecte-toi vite pour vérifier !";

    $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

    // On passe l'URL à la session flash pour que Blade puisse l'attraper
    return redirect()->back()->with([
        'success' => 'Mot de passe mis à jour avec succès !',
        'waUrl' => $waUrl
    ]);
}
}