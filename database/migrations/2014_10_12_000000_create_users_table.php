<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 25);
            $table->string('surname', 25);
            $table->string('username', 25);
            $table->string('email')->unique();
            $table->date('dob');
            $table->string('gender', 15);
            $table->string('password');
            $table->tinyInteger('is_admin')->default(0);
            $table->tinyInteger('warnings')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}