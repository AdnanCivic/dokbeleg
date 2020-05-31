<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBausteinDokumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baustein_dokumentation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dokumentation_id')->unsigned();
            $table->bigInteger('baustein_id')->unsigned();
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
        Schema::dropIfExists('bausteins');
    }
}
