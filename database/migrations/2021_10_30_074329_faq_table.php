<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FaqTable extends Migration
{
    public function up()
    {
        Schema::create('f_a_q_s', function(Blueprint $table){
            $table->id();
            $table->string('question', 140);
            $table->string('answer', 500);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('f_a_q_s');
    }
}
