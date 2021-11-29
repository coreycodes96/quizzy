<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SupporterTable extends Migration
{
    public function up()
    {
        Schema::create('supporters', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('sender');
            $table->index('sender')->foreign('sender')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('receiver');
            $table->foreign('receiver')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supporters');
    }
}
