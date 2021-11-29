<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('quiz_feedback', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('quiz_id');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('body', 2000);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_feedback');
    }
}
