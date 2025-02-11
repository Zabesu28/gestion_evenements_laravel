<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Services\MonsterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
{

    protected $monsterService;
    public function __construct(MonsterService $monsterService)
    {
        $this->monsterService = $monsterService;
    }

    public function index()
    {
        $evenements = Evenement::all();
        return view('evenements.index', compact('evenements'));
    }

    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    }

    public function inscrire(Evenement $evenement)
    {
        $evenement->chasseurs()->attach(Auth::id());
        return redirect()->back()->with('success', 'Inscription réussie !');
    }

    public function desinscrire(Evenement $evenement)
    {
        $evenement->chasseurs()->detach(Auth::id());
        return redirect()->back()->with('success', 'Désinscription réussie !');
    }

    public function create()
    {
        $monsters = $this->monsterService->getMonsters();

        return view('evenements.create', compact('monsters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'monstre' => 'required|string|max:255',
            'recompense' => 'required|string|max:255',
            'temps_completion' => 'required|integer|min:1',
        ]);

        Evenement::create($request->all());

        return redirect()->route('evenements.index')->with('success', 'Quête créée avec succès !');
    }
}