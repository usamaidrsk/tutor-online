<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('size');
            $table->string('type');
            $table->string('path');
            $table
                ->integer('asigment_id')
                ->unsigned()
                ->constrained()
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
