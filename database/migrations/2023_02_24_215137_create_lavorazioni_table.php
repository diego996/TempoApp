<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLavorazioniTable extends Migration
{
    public function up()
    {
        Schema::create('lavorazioni', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('costo');
            $table->unsignedBigInteger('coltura_id');
            $table->foreign('coltura_id')->references('id')->on('colture')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lavorazioni');
    }
}
