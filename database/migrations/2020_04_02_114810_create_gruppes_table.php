<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruppesTable extends Migration
{
    
    public function up()
    {
        Schema::create('gruppes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('dokument_id')->nullable();
            $table->unsignedInteger('dokument_pos')->nullable();
            $table->string('name');
            $table->unsignedSmallInteger('anzahlBausteine');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gruppes');
    }
}
