<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeddingMail; 

class SuperAdminController extends Controller
{
    public function index() {
        $weddings = Wedding::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('weddings'));
    }

    /**
     * L'ADMINISTRATEUR CRÉE LE MARIAGE ET ASSIGNE LE QUOTA MAX
     */
    public function store(Request $request) {
        $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'contact_phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'reception_date' => 'required|date',
            'max_invitations' => 'required|integer|min:1', 
        ]);

        try {
            DB::beginTransaction();

            // Génération d'un mot de passe facile à retenir pour le couple
            $password = strtolower(Str::slug($request->groom_name)) . "2026";

            // 1. Création de l'utilisateur (Le couple)
            $user = User::create([
                'name' => $request->bride_name . ' & ' . $request->groom_name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'role' => 'marié',
            ]);

            // 2. Création du mariage avec le quota d'invitations
            $wedding = Wedding::create([
                'user_id' => $user->id,
                'bride_name' => $request->bride_name,
                'groom_name' => $request->groom_name,
                'contact_phone' => $request->contact_phone,
                'event_date' => $request->reception_date, 
                'reception_time' => $request->reception_time,
                'max_invitations' => $request->max_invitations, 
            ]);

            // 3. Liaison réciproque
            $user->update(['wedding_id' => $wedding->id]);

            // 4. ENVOI DE L'EMAIL
            Mail::to($user->email)->send(new WeddingMail($wedding, $password));

            // 5. On valide TOUT d'un coup en base de données si l'email est bien parti
            DB::commit();

            // 6. Préparation et redirection vers WhatsApp
            $clientLink = route('wedding.client.space');
            $message = "✨ *Félicitations " . $request->bride_name . " & " . $request->groom_name . "* ✨\n\n";
            $message .= "Votre espace privé WedDream est prêt :\n";
            $message .= "🔗 " . $clientLink . "\n\n";
            $message .= "🔐 *Vos accès :*\n";
            $message .= "Email : " . $request->email . "\n";
            $message .= "Mot de passe : " . $password . "\n\n";
            $message .= "Note : Vous pourrez changer votre mot de passe une fois connecté.";

            $cleanPhone = preg_replace('/[^0-9]/', '', $request->contact_phone);
            $whatsappUrl = "https://wa.me/" . $cleanPhone . "?text=" . rawurlencode($message);

            return redirect()->away($whatsappUrl);

        } catch (\Exception $e) {
            // Si l'email ou la base de données échoue, on annule proprement
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la création : ' . $e->getMessage()]);
        }
    }

    /**
     * L'ADMINISTRATEUR PEUT MODIFIER LE QUOTA (OU AUTRES INFOS) EN COURS DE ROUTE
     */
    public function update(Request $request, $id)
    {
        $wedding = Wedding::findOrFail($id);

        $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'contact_phone' => 'required|string',
            'max_invitations' => 'required|integer|min:1', // Permet d'augmenter ou réduire la limite
        ]);

        $wedding->update([
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'contact_phone' => $request->contact_phone,
            'max_invitations' => $request->max_invitations,
        ]);

        return redirect()->back()->with('success', 'Le mariage et sa limite d\'invitations ont été modifiés avec succès !');
    }

    /**
     * GÉNÈRE LA PAGE D'IMPRESSION DU CODE QR POUR LA BORNE D'ACCUEIL D'UN MARIAGE
     */
    public function generateBorneQr($id)
    {
        $wedding = Wedding::findOrFail($id);

        // Clé unique et sécurisée combinée avec l'ID du mariage actuel
        $borneValue = "WEDDING_BORNE_VALID_" . $wedding->id;

        return view('admin.borne-qr', compact('wedding', 'borneValue'));
    }
}