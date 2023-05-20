<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coltura;
use App\Models\Irrigation;
use Illuminate\Support\Facades\Mail;
use App\Mail\IrrigationCompleted;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class IrrigazioniController extends Controller
{
    public function index()
    {
        $irrigazioni = Irrigation::all();

        return view('irrigazioni.index', compact('irrigazioni'));
    }

    public function create()
    {
        $colture = Coltura::all();
        return view('irrigazioni.create', compact('colture'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coltura_id' => 'required|exists:colture,id',
            'data_irrigazione' => 'required|date',
            'note' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $irrigazione = new Irrigation();
        $irrigazione->coltura_id = $request->coltura_id;
        $irrigazione->data_irrigazione = $request->data_irrigazione;
        $irrigazione->note = $request->note;

        $irrigazione->save();

        return redirect()->route('irrigazioni.index')->with('success', 'Irrigazione aggiunta con successo!');
    }

    public function edit($id)
    {
        $irrigazione = Irrigation::find($id);
        $colture = Coltura::all();
        return view('irrigazioni.edit', compact('irrigazione', 'colture'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'coltura_id' => 'required|exists:colture,id',
            'data_irrigazione' => 'required|date',
            'note' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $irrigazione = Irrigation::find($id);
        $irrigazione->coltura_id = $request->coltura_id;
        $irrigazione->data_irrigazione = $request->data_irrigazione;
        $irrigazione->note = $request->note;

        $irrigazione->update();

        return redirect()->route('irrigazioni.index')->with('success', 'Irrigazione aggiornata con successo!');
    }

    public function destroy($id)
    {
        $irrigazione = Irrigation::find($id);
        $irrigazione->delete();
        return redirect()->route('irrigazioni.index')->with('success', 'Irrigazione eliminata con successo!');
    }

    public function complete(Request $request)
    {
        // Recupera tutte le colture da irrigare
        $coltureDaIrrigare = [];
        $colture = Coltura::all();
        foreach ($colture as $coltura) {
            $ultimaIrrigazione = Irrigation::where('coltura_id', $coltura->id)->latest()->first();
            if (!$ultimaIrrigazione) {
                // Se non esiste una irrigazione precedente, la crea
                Irrigation::create([
                    'coltura_id' => $coltura->id,
                    'data' => Carbon::today(),
                    'note' => 'Irrigazione automatica',
                ]);
            } else {
                $faseColtura = $coltura->getFaseColtura();
                $giorniTraIrrigazioni = $faseColtura === 'crescita' ? $coltura->giorni_irrigazione_crescita : $coltura->giorni_irrigazione_produzione;
                $ultimaIrrigazioneData = Carbon::parse($ultimaIrrigazione->data);
                $oggi = Carbon::today();
                if ($oggi->diffInDays($ultimaIrrigazioneData) >= $giorniTraIrrigazioni) {
                    $coltureDaIrrigare[] = $coltura;
                }
            }
        }

        // Aggiorna la data di irrigazione di tutte le colture da irrigare
        foreach ($coltureDaIrrigare as $coltura) {
            Irrigation::create([
                'coltura_id' => $coltura->id,
                'data' => Carbon::today(),
                'note' => 'Irrigazione automatica',
            ]);
        }

        // Invia una email di notifica
        $to = 'destinatario@example.com';
        $subject = 'Irrigazione completata';
        $body = 'Le colture sono state irrigate con successo.';

        Mail::to($to)->send(new IrrigationCompleted($subject, $body));

        // In alternativa, potresti utilizzare una libreria esterna per l'invio di email
        // come ad esempio Laravel Mail o Mailgun.
    }

    public function irrigazione_tramite_email(){
        $cultures = Coltura::all();
        foreach ($cultures as $culture) {
            $lastIrrigation = Irrigation::where('colture_id', $culture->id)
                ->orderBy('last_irrigation', 'desc')
                ->first();

            $daysToIrrigate = $lastIrrigation->days_to_irrigate;

            if ($lastIrrigation) {
                $daysSinceIrrigation = Carbon::parse($lastIrrigation->last_irrigation)
                    ->diffInDays(Carbon::now());

                if ($daysSinceIrrigation >= $daysToIrrigate) {
                    $culturesToIrrigate[] = $culture;
                }

            } else {
                $culturesToIrrigate[] = $culture;
            }
        }

        if (!empty($culturesToIrrigate)) {
            $irrigationData = [];
            foreach ($culturesToIrrigate as $culture) {

               $cultura1 = Coltura::find($culture["id"])->irrigazioni();
                dd($cultura1->irrigazioni->last_irrigation);
                $cultura1->last_irrigation = Carbon::now();
                $cultura1->update();
            }
        }else{

        }
    }

}