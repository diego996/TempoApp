<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Coltura;
use App\Models\Irrigation;
use Illuminate\Support\Facades\Mail;
use App\Mail\IrrigationNotification;
use Carbon\Carbon;

class IrrigationCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'irrigation:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check colture da irrigare';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cultures = Coltura::all();
        $testo = "lanciato comando irrigazione check ".now();


        foreach ($cultures as $culture) {
            $lastIrrigation = Irrigation::where('colture_id', $culture->id)
                ->orderBy('last_irrigation', 'desc')
                ->first();
            if(isset($lastIrrigation->days_to_irrigate)){
                $daysToIrrigate = $lastIrrigation->days_to_irrigate;
            }else{
                $daysToIrrigate = 0;
            }

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

                $irrigationData[] = [
                    'colture_id' => $culture->nome,
                    'phase' => $culture->phase,
                    'last_irrigation' => $lastIrrigation ? Carbon::parse($lastIrrigation->last_irrigation)->format("d/m/Y") : 'N/A',
                    'days_to_irrigate' => $lastIrrigation->days_to_irrigate
                ];
            }



            // Invio email di notifica con le colture da irrigare
            Mail::to('diego.barza996@gmail.com','mauro.barza.mb@gmail.com')
                ->send(new IrrigationNotification($irrigationData,$testo));
        }else{
            Mail::to('diego.barza996@gmail.com')
                ->send(new IrrigationNotification("test",$testo));
        }


    }

}
