<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Models\WeddingProgram;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Affiche l'interface du programme pour un mariage spécifique.
     */
    public function index($id)
    {
        $wedding = Wedding::with('programs')->findOrFail($id);
        
        return view('Program.index', compact('wedding'));
    }

    /**
     * Enregistre ou met à jour les étapes du programme.
     */
    public function store(Request $request, $id)
    {
        $wedding = Wedding::findOrFail($id);

        // Validation des données
        $validatedData = $request->validate([
            'programs' => 'required|array',
            'programs.*.type' => 'required|string',
            'programs.*.event_date' => 'nullable|date',
            'programs.*.event_time' => 'nullable',
            'programs.*.venue_name' => 'nullable|string|max:255',
        ]);

        foreach ($validatedData['programs'] as $programData) {
            // On n'enregistre que si la date et le lieu sont remplis
            if (!empty($programData['event_date']) && !empty($programData['venue_name'])) {
                $wedding->programs()->updateOrCreate(
                    ['type' => $programData['type']], // Condition : même type pour ce mariage
                    [
                        'event_date' => $programData['event_date'],
                        'event_time' => $programData['event_time'],
                        'venue_name' => $programData['venue_name'],
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Votre programme a été mis à jour avec succès.');
    }
}