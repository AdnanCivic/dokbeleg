<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumentsTable extends Migration
{
    
    public function up()
    {
        Schema::create('dokuments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->unsignedSmallInteger('anzahlGruppen');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('dokuments');
    }
}
