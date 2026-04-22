<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    public function index()
    {
        $depenses = Auth::user()->depenses()->orderBy('date', 'desc')->get();
        return response()->json($depenses);
    }

    public function store(Request $request)
{
    // Debug temporaire
    \Log::info('Files reçus:', $request->allFiles());
    \Log::info('Fields reçus:', $request->all());
    $request->validate([
        'date'            => 'required|date',
        'objet_depense'   => 'required|string',
        'montant_depense' => 'required|numeric|min:0',
        'justificatif'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    $justificatifPath = null;
    if ($request->hasFile('justificatif')) {
        $justificatifPath = $request->file('justificatif')
            ->store('justificatifs', 'public');
    }

    $depense = Auth::user()->depenses()->create([
        'date'            => $request->date,
        'objet_depense'   => $request->objet_depense,
        'montant_depense' => $request->montant_depense,
        'justificatif'    => $justificatifPath,
    ]);

    return response()->json($depense, 201);
}

    public function destroy($id)
    {
        $depense = Auth::user()->depenses()->findOrFail($id);
        $depense->delete();
        return response()->json(null, 200);
    }
}