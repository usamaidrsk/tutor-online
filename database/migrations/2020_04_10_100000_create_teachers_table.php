<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->string('phone', 15)->nullable();
            $table->string('picture')->nullable();
            $table->string('document')->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('answered_questions')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table
                ->tinyInteger('country_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();

            $table
                ->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
