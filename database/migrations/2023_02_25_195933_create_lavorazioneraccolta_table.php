<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLavorazioneraccoltaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lavorazione_raccolta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raccolta_id')->on('raccolte');
            $table->foreignId('lavorazione_id')->on('lavorazioni');
            $table->integer('quantita_utilizzata')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lavorazione_raccolta');
    }
}
