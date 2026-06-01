<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wedding, Invitation, Drink}; 
use Illuminate\Support\Facades\{Auth, Storage};
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Espace admin : regroupe les vœux et albums de tous les invités confirmés.
     */
    public function magazine() 
    {
        $wedding = Wedding::first(); 
        
        if (!$wedding) {
            abort(404, "Aucun mariage trouvé en base de données.");
        }

        $invitations = Invitation::where('wedding_id', $wedding->id)
            ->whereNotNull('wedding_wish')
            ->where('wedding_wish', '!=', '') 
            ->get();

        return view('admin.magazine', compact('wedding', 'invitations'));
    }

    /**
     * Affiche la sélection des modèles d'invitations.
     */
    public function selectionModeles()
    {
        $wedding = Wedding::where('user_id', Auth::id())->firstOrFail();
        
        $categories = [
            'premium' => ['Eclat d\'Or', 'Soie Blanche', 'Minimaliste Chic'],
            'vip'     => ['Diamant Noir', 'Velours Royal', 'Héritage'],
            'groupe'  => ['Festivités', 'Standard Élégant', 'Équipe Élite']
        ];

        return view('invitation.selection-modeles', compact('wedding', 'categories'));
    }

    /**
     * Enregistre la configuration visuelle et les modèles choisis.
     */
    public function saveSettings(Request $request)
    {
        $wedding = Wedding::where('user_id', Auth::id())->firstOrFail();

        $data = [
            'model_premium' => $request->model_premium,
            'model_vip'     => $request->model_vip,
            'model_group'   => $request->model_group,
        ];

        if ($request->hasFile('cover_photo')) {
            if ($wedding->cover_photo) {
                Storage::disk('public')->delete($wedding->cover_photo);
            }
            $path = $request->file('cover_photo')->store('weddings', 'public');
            $data['cover_photo'] = $path;
        }

        $wedding->update($data);

        return redirect()->back()->with('success', 'Configuration mise à jour avec succès !');
    }

    /**
     * Liste toutes les invitations liées au mariage de l'utilisateur connecté.
     */
    public function index()
    {
        $wedding = Wedding::where('user_id', Auth::id())->firstOrFail();
        $invitations = Invitation::where('wedding_id', $wedding->id)->get();
        
        return view('invitation.index', compact('wedding', 'invitations'));
    }

    /**
     * Crée et génère une nouvelle invitation avec un jeton unique.
     */
    public function store(Request $request)
    {
        $wedding = Wedding::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'guest_name'   => 'required|string|max:255',
            'type'         => 'required|in:singleton,couple,groupe',
            'access_count' => 'required|integer|min:1',
            'phone'        => 'nullable|string',
        ]);

        Invitation::create([
            'wedding_id'   => $wedding->id,
            'guest_name'   => $request->guest_name,
            'type'         => $request->type,
            'access_count' => $request->access_count,
            'phone'        => $request->phone,
            'link_token'   => Str::random(20),
        ]);

        return redirect()->back()->with('success', 'Invitation ajoutée à la liste !');
    }

    /**
     * Supprime une invitation de la liste.
     */
    public function destroy($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();

        return redirect()->back()->with('success', 'Invitation supprimée.');
    }

    /**
     * Vue d'accueil personnalisée pour l'invité (via son lien unique).
     */
    public function guestWelcome($token)
    {
        $invitation = Invitation::where('link_token', $token)->firstOrFail();
        $wedding = Wedding::find($invitation->wedding_id);

        if (!$wedding) {
            abort(404, "Le mariage associé à cette invitation n'existe pas.");
        }

        $titleParts = explode('&', $wedding->title ?? 'Marié & Mariée');
        $groom = trim($titleParts[0] ?? 'Marié');
        $bride = trim($titleParts[1] ?? 'Mariée');

        return view('guest.welcome', compact('invitation', 'wedding', 'groom', 'bride'));
    }

    /**
     * Formulaire RSVP d'un invité (affiche la liste des boissons de l'événement).
     */
    public function rsvpForm($token)
    {
        $invitation = Invitation::where('link_token', $token)->firstOrFail();
        $wedding = Wedding::find($invitation->wedding_id);
        
        if (!$wedding) {
            abort(404, "Le mariage associé à cette invitation n'existe pas.");
        }

        $drinks = $wedding->drinks; 
        
        return view('guest.rsvp', compact('invitation', 'wedding', 'drinks'));
    }

    /**
     * Affiche l'état ou le formulaire RSVP d'une invitation spécifique.
     */
    public function showRsvp($token)
    {
        $invitation = Invitation::where('link_token', $token)->firstOrFail();
        $drinks = Drink::where('wedding_id', $invitation->wedding_id)->get();

        return view('guest.rsvp', compact('invitation', 'drinks'));
    }

    /**
     * Traite et enregistre la réponse RSVP (Retourne une vue de succès) avec photos.
     */
    public function submitRsvp(Request $request, $token)
    {
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('memory_limit', '256M');

        $invitation = Invitation::where('link_token', $token)->firstOrFail();

        $request->validate([
            'rsvp_status'    => 'required|in:confirme,decline',
            'preorder_drink' => 'nullable|array',
            'wedding_wish'   => 'nullable|string',
            'photos'         => 'nullable|array',
            'photos.*'       => 'nullable', 
        ]);

        if ($request->rsvp_status === 'confirme' && $request->has('preorder_drink')) {
            $invitation->preorder_drink = is_array($request->preorder_drink) 
                ? $request->preorder_drink 
                : array_filter(explode(',', $request->preorder_drink));
        }

        $uploadedPhotos = is_array($invitation->guest_photos) ? $invitation->guest_photos : [];
        if ($request->rsvp_status === 'confirme' && $request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $uploadedPhotos[] = $photo->store('weddings', 'public');
                }
            }
            $invitation->guest_photos = $uploadedPhotos;
        }

        $invitation->rsvp_status = $request->rsvp_status;
        $invitation->wedding_wish = $request->wedding_wish;
        
        if ($request->rsvp_status === 'decline') {
            $invitation->decline_reason = $request->decline_reason;
        }

        $invitation->save();

        return view('guest.rsvp_success', compact('invitation'));
    }

    /**
     * Traite et enregistre la réponse RSVP (Redirige vers l'accueil invité) avec photos.
     */
    public function rsvpSubmit(Request $request, $token)
    {
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('memory_limit', '256M');

        $invitation = Invitation::where('link_token', $token)->firstOrFail();

        $request->validate([
            'rsvp_status'    => 'required|in:confirme,decline',
            'decline_reason' => 'nullable|string',
            'preorder_drink' => 'nullable|array',
            'wedding_wish'   => 'nullable|string|max:1000',
            'photos'         => 'nullable|array',
            'photos.*'       => 'nullable', 
        ]);

        if ($request->rsvp_status === 'confirme' && $request->has('preorder_drink')) {
            $invitation->preorder_drink = $request->preorder_drink;
        }

        $uploadedPhotos = is_array($invitation->guest_photos) ? $invitation->guest_photos : [];
        if ($request->rsvp_status === 'confirme' && $request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo && $photo->isValid()) {
                    $uploadedPhotos[] = $photo->store('weddings', 'public');
                }
            }
            $invitation->guest_photos = $uploadedPhotos;
        }

        $invitation->rsvp_status = $request->rsvp_status;
        $invitation->wedding_wish = $request->wedding_wish; 
        
        if ($request->rsvp_status === 'decline') {
            $invitation->decline_reason = $request->decline_reason;
        }

        $invitation->save();

        return redirect()->route('guest.welcome', $token)->with('success', 'Votre réponse a bien été enregistrée. Merci !');
    }

    /**
     * CODE CORRIGÉ POUR RENDRE LA DATE ET LE PROGRAMME DYNAMIQUES
     */
    public function print($id)
    {
        // 1. Récupère l'invitation
        $invitation = Invitation::findOrFail($id);
        
        // 2. Récupère le mariage ET charge explicitement sa relation 'programs'
        $wedding = Wedding::with(['programs' => function($query) {
            $query->orderBy('event_date', 'asc')->orderBy('event_time', 'asc');
        }])->findOrFail($invitation->wedding_id);

        // 3. Envoie le tout à la vue 'invitation.print'
        return view('invitation.print', compact('invitation', 'wedding'));
    }
}