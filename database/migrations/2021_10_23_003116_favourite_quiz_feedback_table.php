<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FavouriteQuizFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('favourite_quiz_feedback', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('quiz_feedback_id');
            $table->foreign('quiz_feedback_id')->references('id')->on('quiz_feedback')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('favourite_quiz_feedback');
    }
}
