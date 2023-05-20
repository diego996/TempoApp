<?php

namespace Database\Seeders;
use App\Models\Coltura;
use App\Models\Irrigation;
use Illuminate\Database\Seeder;

class IrrigationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Irrigation::truncate();

        $colture = Coltura::all();

        foreach ($colture as $coltura) {
            Irrigation::create([
                'colture_id' => $coltura->id,
                'notes' => "",
                'last_irrigation' => now(),
                'days_to_irrigate' => 2,
            ]);
        }
    }
}
