<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnnouncementTable extends Migration
{
    public function up()
    {
        Schema::create('announcements', function(Blueprint $table){
            $table->id();
            $table->string('title', 140);
            $table->string('body', 700);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
