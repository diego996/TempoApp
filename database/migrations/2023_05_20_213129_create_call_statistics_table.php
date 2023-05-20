<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('call_statistics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedInteger('call_count')->default(0);
            $table->string('type');
            $table->text('response');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('call_statistics');
    }
}
