<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumentGruppeTable extends Migration
{
    
    public function up()
    {
        Schema::create('dokument_gruppe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dokument_id')->unsigned();
            $table->bigInteger('gruppe_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokument_gruppe');
    }
}
