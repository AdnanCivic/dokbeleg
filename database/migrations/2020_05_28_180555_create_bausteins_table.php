<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBausteinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bausteins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('gruppe_id')->nullable();
            $table->unsignedInteger('gruppe_pos')->nullable();
            $table->string('name');
            $table->string('typ');
            $table->text('heading');
            $table->longText('content')->charset('utf8');
            $table->unsignedInteger('marker')->nullable();
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('bausteins');
    }
}
