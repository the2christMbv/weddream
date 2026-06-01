<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagazineController extends Controller
{
    /**
     * Liste tous les mariages dans l'espace admin.
     */
    public function index()
    {
        // Récupère les mariages avec le compte des invitations associées
        $weddings = Wedding::withCount(['invitations' => function ($query) {
            $query->whereNotNull('wedding_wish')
                  ->orWhereNotNull('guest_photos');
        }])->latest()->get();

        return view('admin.magazine_index', compact('weddings'));
    }

    /**
     * Affiche le magazine / livre d'or d'un mariage précis.
     */
    public function show(Wedding $wedding)
    {
        // RÉSOLUTION DU BUG D'AFFICHAGE :
        // On récupère toutes les invitations qui appartiennent soit directement au mariage via 'wedding_id',
        // soit indirectement via la table de mariage 'wedding_table_id'.
        $invitations = Invitation::where('wedding_id', $wedding->id)
            ->orWhereHas('weddingTable', function ($query) use ($wedding) {
                $query->where('wedding_id', $wedding->id);
            })
            ->get();

        return view('admin.magazine', compact('wedding', 'invitations'));
    }

    /**
     * Permet de télécharger une photo individuellement.
     */
    public function downloadPhoto(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        $path = trim($request->query('path'));

        // Sécurité : Vérifie que le fichier existe bien dans le storage public
        if (Storage::disk('public')->exists($path)) {
            
            // Nettoyer la mémoire tampon du serveur pour éviter les fichiers corrompus
            if (ob_get_level()) {
                ob_end_clean();
            }

            // Récupérer le chemin absolu sur le disque dur
            $absolutePath = Storage::disk('public')->path($path);
            $fileName = basename($path);

            // Forcer le téléchargement avec les en-têtes HTTP de base
            return response()->download($absolutePath, $fileName, [
                'Content-Type' => Storage::disk('public')->mimeType($path),
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }

        return back()->with('error', 'Le fichier demandé n\'existe pas.');
    }
}