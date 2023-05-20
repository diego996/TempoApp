<?php


namespace App\Http\Controllers;

use App\Models\Lavorazione;
use Illuminate\Http\Request;
use App\Models\Coltura;

class LavorazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $colture = Coltura::all();
        foreach ($colture as $coltura){
            $array_colture[$coltura->id] = $coltura;
        }

        $lavorazioni = Lavorazione::all();
        foreach ($lavorazioni as $lavorazione){
            $nome_coltura[$lavorazione->coltura_id] =  $array_colture[$lavorazione->coltura_id]->nome;
        }
        if(!isset($nome_coltura)){
            $nome_coltura[] ="";
        }
        return view('lavorazioni.index', compact('colture','lavorazioni',"nome_coltura"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lavorazioni.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'descrizione' => 'required',
            'coltura_id' => 'required',
            'tipo_lavorazione' => 'required',
            'data_lavorazione' => 'nullable|date'
        ]);



        $lavorazione = new Lavorazione();
        $lavorazione->nome = $validatedData['nome'];
        $lavorazione->descrizione = $validatedData['descrizione'];
        $lavorazione->coltura_id = $validatedData['coltura_id'];
        $lavorazione->tipo_lavorazione = strtoupper($validatedData['tipo_lavorazione']);
        $lavorazione->data_lavorazione = $validatedData['data_lavorazione'] ?: now();
        $lavorazione->costo = 0 ;
        $lavorazione->save();

        return redirect()->route('lavorazioni.index')
            ->with('success', 'Lavorazione creata con successo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lavorazione  $lavorazione
     * @return \Illuminate\Http\Response
     */
    public function show(Lavorazione $lavorazione)
    {
        $colture = Coltura::all();
        $lavorazioni = Lavorazione::with('coltura')->get();
        return view('lavorazioni.show', compact('colture','lavorazioni'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lavorazione  $lavorazione
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lavorazione = Lavorazione::find($id);
        $colture = Coltura::all();
        return view('lavorazioni.edit', compact('lavorazione', 'colture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lavorazione  $lavorazione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'descrizione' => 'required',
            'costo' => 'required|numeric|min:0',
            'coltura_id' => 'required|numeric|min:0',
//            'tipo_lavorazione' => 'required',
        ]);

        $lavorazione = Lavorazione::findOrFail($id);
        $lavorazione->nome = $validatedData['nome'];
        $lavorazione->coltura_id = $validatedData['coltura_id'];
//        $lavorazione->tipo_lavorazione = $validatedData['tipo_lavorazione'];
        $lavorazione->descrizione = $validatedData['descrizione'];
        $lavorazione->costo = $validatedData['costo'];
        $lavorazione->updateOrFail();

        return redirect()->route('lavorazioni.index')
            ->with('success', 'Lavorazione aggiornata con successo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lavorazione  $lavorazione
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lavorazione = Lavorazione::findOrFail($id);
        $lavorazione->delete();

        return redirect()->route('lavorazioni.index')
            ->with('success', 'Lavorazione eliminata con successo.');
    }
}
