<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raccolte;
use App\Models\Coltura;
use App\Models\Lavorazione;

class RaccoltaController extends Controller
{
    public function index()
    {
        $raccolte = Raccolte::all();
        return view('raccolta.index', compact('raccolte'));
    }

    public function show($id)
    {
        $raccolta = Raccolte::find($id);
        return view('raccolta.show', compact('raccolta'));
    }

    public function create()
    {
        $colture = Coltura::all();
        $lavorazioni = Lavorazione::all();
        return view('raccolta.create', compact('colture', 'lavorazioni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantita' => 'required|numeric|min:0',
            'data' => 'required|date',
            'coltura_id' => 'required|exists:colture,id',
            'commento' => 'required'
        ]);

        $raccolta = new Raccolte();
        $raccolta->quantita = $request->quantita;
        $raccolta->data_raccolta = $request->data;
        $raccolta->coltura_id = $request->coltura_id;
        $raccolta->note = $request->commento;
        $raccolta->save();

        if($request->has('lavorazioni')) {
            $raccolta->lavorazioni()->attach($request->lavorazioni);
        }

        return redirect()->route('raccolta.index')->with('success', 'Raccolta creata con successo!');
    }

    public function edit($id)
    {
        $raccolta = Raccolte::find($id);
        $colture = Coltura::all();
        $lavorazioni = Lavorazione::all();
        return view('raccolta.edit', compact('raccolta', 'colture', 'lavorazioni'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantita' => 'required|numeric|min:0',
            'data' => 'required|date',
            'coltura_id' => 'required|exists:colture,id',
            'commento' => 'required|'
        ]);
        $raccolta = Raccolte::find($id);
        $raccolta->quantita = $request->quantita;
        $raccolta->data_raccolta = $request->data;
        $raccolta->coltura_id = $request->coltura_id;
        $raccolta->note = $request->commento;
        $raccolta->update();

        return redirect()->route('raccolta.index')->with('success', 'Raccolta modificata con successo!');
    }

    public function destroy($id)
    {
        $raccolta = Raccolte::find($id);
        $raccolta->delete();
        return redirect()->route('raccolta.index')->with('success', 'Raccolta eliminata con successo!');
    }
}
