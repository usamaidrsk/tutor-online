<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->char('token', 10)->unique();
            $table
                ->integer('asigment_id')
                ->unsigned()
                ->constrained()
                ->onDelete('cascade');
            $table
                ->integer('teacher_id')
                ->unsigned()
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
