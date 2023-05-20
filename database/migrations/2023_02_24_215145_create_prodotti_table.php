<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdottiTable extends Migration
{
    public function up()
    {
        Schema::create('prodotti', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('prezzo');
            $table->float('costo');
            $table->unsignedBigInteger('lavorazione_id');
            $table->foreign('lavorazione_id')->references('id')->on('lavorazioni')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prodotti');
    }
}
