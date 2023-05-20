<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColtureTable extends Migration
{
    public function up()
    {
        Schema::create('colture', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('costo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colture');
    }
}
