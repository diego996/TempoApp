<?php

namespace App\Http\Controllers;
use App\Models\Raccolte;
use App\Models\Coltura;
use App\Models\Lavorazione;
use Illuminate\Http\Request;

class ColturaController extends Controller
{
    public function index()
    {
        $lavorazioni = Lavorazione::all();
        $costi_colture = array();
        $costi_totali = 0;
        $profitto = 0;
        foreach ($lavorazioni as $lavorazione){
            $costi_totali = $costi_totali + $lavorazione->costo;
            if(isset($costi_colture[$lavorazione->coltura_id])){
                $costi_colture[$lavorazione->coltura_id] = $lavorazione->costo + $costi_colture[$lavorazione->coltura_id];
            }else{
                $costi_colture[$lavorazione->coltura_id] = $lavorazione->costo ;
            }


        }


        $colture = Coltura::all();
        foreach ($colture as $coltura){
            $raccolte = Raccolte::where("coltura_id","$coltura->id")->get();
            if(count($raccolte)>0){
                $quantita_raccolta[$coltura->id] = 0;
                $profitto_array[$coltura->id]  = 0;
            foreach ($raccolte as $raccolta){
                $quantita_raccolta[$coltura->id] = $quantita_raccolta[$coltura->id] + $raccolta->quantita;
            }
                $profitto = $this->calculateProfit($quantita_raccolta[$coltura->id],$coltura->id);
                $profitto_array[$coltura->id] = $profitto_array[$coltura->id] + $profitto;
            }else{
                $quantita_raccolta[$coltura->id] = 0;
                $profitto_array[$coltura->id] = $this->calculateProfit(0,$coltura->id);
            }
        }
        $result = $this->getPariOrProfittoQuantities(0);
        return view('colture.index', compact('colture',"costi_colture","costi_totali","profitto","profitto_array","result","quantita_raccolta"));
    }

    public function getPariOrProfittoQuantities($profittoPercent = null) {
        $colture = Coltura::all();
        $result = [];

        foreach ($colture as $coltura) {
            $lavorazioni = $coltura->lavorazioni($coltura->id);

            // Calcolo il costo totale delle lavorazioni
            $costoLavorazioni = $lavorazioni->sum('costo');

            // Se ho un profittoPercent, calcolo il profitto che voglio ottenere
            $profitto = null;
            if ($profittoPercent !== null) {
                $costoProduzione = $coltura->costo_produzione;
                $prezzoVendita = $coltura->prezzo_vendita;
                $costoTotale = $costoProduzione + $costoLavorazioni;
                $profitto = $prezzoVendita - $costoTotale;
                $profitto *= $profittoPercent / 100;
            }
            if($coltura->prezzo_vendita==0){
                $quantitaPari = "nessun prezzo impostato";
                $quantitaProfitto = "nessun prezzo impostato";
            }else{
                $quantitaProfitto = $profitto === null ? null : ceil(($costoLavorazioni + $profitto) / $coltura->prezzo_vendita * 1000) ." g";
                $quantitaPari = ceil($costoLavorazioni / $coltura->prezzo_vendita * 1000)." g";
            }
            // Calcolo la quantità minima per arrivare in pari o ottenere il profitto desiderato


            $result[$coltura->id] = [
                'nome' => $coltura->nome,
                'quantita_pari' => $quantitaPari,
                'quantita_profitto' => $quantitaProfitto
            ];
        }

        return $result;
    }



    public function calculateProfit($grams, $coltura_id)
    {
        $coltura = Coltura::find($coltura_id);
        $prezzo_kg = $coltura->prezzo_vendita;
        $costo_totale = 0;
        foreach ($coltura->lavorazioni($coltura_id) as $lavorazione) {
            $costo_totale += $lavorazione->costo;
        }
        $profitto = (floatval($grams) / 1000) * floatval($prezzo_kg) - $costo_totale;
        return $profitto;
    }

    public function create()
    {
        return view('colture.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descrizione' => 'required',
            'semenza' => 'required',
        ]);

        $coltura = new Coltura;
        $coltura->nome = strtoupper($request->nome);
        $coltura->semenza = strtoupper($request->semenza);
        $coltura->costo = "0";
        $coltura->descrizione = $request->descrizione;
        $coltura->save();

        return redirect()->route('colture.index')->with('success', 'Coltura creata con successo.');
    }

    public function show($id)
    {
        $coltura = Coltura::findOrFail($id);
        $lavorazioni = $coltura->lavorazioni($id);

        return view('colture.show', compact('coltura',"lavorazioni"));
    }

    public function edit($id)
    {
        $coltura = Coltura::findOrFail($id);
        $lavorazioni = $coltura->lavorazioni($id);
        $lavorazioniSelezionate = $lavorazioni;
        return view('colture.edit', compact('coltura',"lavorazioni","lavorazioniSelezionate"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'costo' => 'required|numeric|min:0',
            'descrizione' => 'required',
        ]);
        $coltura = Coltura::findOrFail($id);
        $coltura->nome = $request->nome;
        $coltura->descrizione = $request->descrizione;
        $coltura->costo = $request->costo;
        $coltura->prezzo_vendita = $request->prezzo_vendita;
        $coltura->update();

        return redirect()->route('colture.index')->with('success', 'Coltura aggiornata con successo.');
    }

    public function destroy($id)
    {
        $coltura = Coltura::findOrFail($id);
        $coltura->delete();
        return redirect()->route('colture.index')->with('success', 'Coltura eliminata con successo.');
    }
}
