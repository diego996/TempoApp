<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaccolteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raccolte', function (Blueprint $table) {
            $table->id();
            $table->integer('quantita');
            $table->date('data_raccolta');
            $table->text('note')->nullable();
            $table->foreignId('coltura_id')->on('colture');
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
        Schema::dropIfExists('raccolte');
    }
}
