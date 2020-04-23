<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            // TODO:
            // - Add `last_login` column

            $table->increments('id');
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->string('phone', 15)->nullable();
            $table->string('picture')->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('answered_questions')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table
                ->tinyInteger('country_id')
                ->unsigned()
                ->constrained()
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
