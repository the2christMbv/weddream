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

    public function store(Request $request) {
        $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'contact_phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'reception_date' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            // Génération d'un mot de passe facile à retenir pour le couple
            // Exemple : jean2026
            $password = strtolower(Str::slug($request->groom_name)) . "2026";

            $user = User::create([
                'name' => $request->bride_name . ' & ' . $request->groom_name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'role' => 'marié',
            ]);

            $wedding = Wedding::create([
    'user_id' => $user->id, // Le propriétaire
    'bride_name' => $request->bride_name,
    'groom_name' => $request->groom_name,
    'contact_phone' => $request->contact_phone,
    'reception_date' => $request->reception_date,
    'reception_time' => $request->reception_time,
]);
$user->update(['wedding_id' => $wedding->id]);

            DB::commit();

            // Envoi de l'email
            Mail::to($user->email)->send(new WeddingMail($wedding, $password));

            // Message WhatsApp automatique avec le MDP en clair
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
            DB::rollback();
            return back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }
}