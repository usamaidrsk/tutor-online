<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsigmentsTable extends Migration
{
    public function up()
    {
        Schema::create('asigments', function (Blueprint $table) {
            $table->id();
            $table->string('email', 50)->unique();
            $table->string('phone', 15);
            $table->string('details', 300);
            $table->decimal('budget', 8, 2);
            $table->timestamp('date');
            $table->unsignedTinyInteger('level_id');
            $table->unsignedTinyInteger('category_id');

            $table
                ->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('cascade');
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asigments');
    }
}