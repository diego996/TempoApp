<?php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;
use App\Models\Coltura;
use App\Models\Lavorazione;

class ProdottoController extends Controller
{
    public function index()
    {
        $prodotti = Prodotto::all();
        return view('prodotti.index', ['prodotti' => $prodotti]);
    }

    public function create()
    {
        $colture = Coltura::all();
        $lavorazioni = Lavorazione::all();
        return view('prodotti.create', ['colture' => $colture, 'lavorazioni' => $lavorazioni]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'prezzo' => 'required|numeric',
            'quantita' => 'required|integer',
            'coltura_id' => 'required|exists:colture,id',
            'lavorazioni.*.id' => 'exists:lavorazioni,id'
        ]);

        $prodotto = new Prodotto();
        $prodotto->nome = $request->input('nome');
        $prodotto->descrizione = $request->input('descrizione');
        $prodotto->prezzo = $request->input('prezzo');
        $prodotto->quantita = $request->input('quantita');
        $prodotto->coltura_id = $request->input('coltura_id');
        $prodotto->save();

        $lavorazioni = $request->input('lavorazioni');
        if (!empty($lavorazioni)) {
            $prodotto->lavorazioni()->attach($lavorazioni);
        }

        return redirect()->route('prodotti.index');
    }

    public function show($id)
    {
        $prodotto = Prodotto::find($id);
        return view('prodotti.show', ['prodotto' => $prodotto]);
    }

    public function edit($id)
    {
        $prodotto = Prodotto::find($id);
        $colture = Coltura::all();
        $lavorazioni = Lavorazione::all();
        return view('prodotti.edit', ['prodotto' => $prodotto, 'colture' => $colture, 'lavorazioni' => $lavorazioni]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Prodotto $prodotto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodotto $prodotto)
    {
        $request->validate([
            'nome' => 'required',
            'descrizione' => 'required',
            'prezzo' => 'required|numeric',
            'id_coltura' => 'required|exists:colture,id',
            'id_lavorazione' => 'required|exists:lavorazioni,id'
        ]);

        $prodotto->nome = $request->input('nome');
        $prodotto->descrizione = $request->input('descrizione');
        $prodotto->prezzo = $request->input('prezzo');
        $prodotto->id_coltura = $request->input('id_coltura');
        $prodotto->id_lavorazione = $request->input('id_lavorazione');
        $prodotto->save();

        return redirect()->route('prodotti.show', ['prodotto' => $prodotto])->with('status', 'Prodotto aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodotto $prodotto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodotto $prodotto)
    {
        $prodotto->delete();

        return redirect()->route('prodotti.index')->with('status', 'Prodotto eliminato con successo!');
    }
}