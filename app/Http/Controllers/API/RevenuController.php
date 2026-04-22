<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Revenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenuController extends Controller
{
    public function index()
    {
        $revenus = Auth::user()->revenus()->orderBy('date', 'desc')->get();
        return response()->json($revenus);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'origine' => 'required|string',
            'montant' => 'required|numeric|min:0',
        ]);

        $revenu = Auth::user()->revenus()->create([
            'date' => $request->date,
            'origine' => $request->origine,
            'montant' => $request->montant,
        ]);

        return response()->json($revenu, 201);
    }

    public function destroy($id)
    {
        $revenu = Auth::user()->revenus()->findOrFail($id);
        $revenu->delete();
        return response()->json(null, 200);
    }
}
