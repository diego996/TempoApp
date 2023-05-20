<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColturaController;
use App\Http\Controllers\LavorazioneController;
use App\Http\Controllers\ProdottoController;
use App\Http\Controllers\RaccoltaController;
use App\Http\Controllers\IrrigazioniController;
use App\Http\Controllers\HomeController;

Route::get('/{city?}', [HomeController::class, 'index'])->name('home.index');

Route::get('/', function () {
    return view('welcome');
});


Route::resource('colture', ColturaController::class);
Route::resource('lavorazioni', LavorazioneController::class);
Route::resource('prodotti', ProdottoController::class);
Route::resource('raccolta', RaccoltaController::class);
Route::resource('irrigazioni', IrrigazioniController::class);

Auth::routes();


use App\Models\Coltura;


Route::get('/autocomplete', function() {
    $term = request('term');
    $products = Coltura::where("semenza","LIKE","%$term%")->limit(1)->get();
    $result = [];
    foreach ($products as $product) {
        $result[] = [
            'id' => $product->id,
            'value' => $product->semenza
        ];
    }
    return response()->json($result);
})->name('autocomplete');

Route::get('/agro', [App\Http\Controllers\AgromonitoringController::class, 'getWeatherDataForAllPolygons'])->name('home');
Route::get('agromonitoring/weather-data/{polygonId}', [App\Http\Controllers\AgromonitoringController::class, 'getWeatherData'])->name('weather-data');
Route::get('agromonitoring/weather/today/{polygonId}', [App\Http\Controllers\AgromonitoringController::class, 'getTodayWeatherData'])->name('weather-data');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/irrigazione_tramite_email', [App\Http\Controllers\IrrigazioniController::class, 'irrigazione_tramite_email'])->name('irrigazione_tramite_email');
