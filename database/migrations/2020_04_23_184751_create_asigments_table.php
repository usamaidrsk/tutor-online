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
            $table->string('email', 50);
            $table->string('details', 300);
            $table->decimal('budget', 8, 2);
            $table
                ->tinyInteger('level_id')
                ->unsigned()
                ->constrained();
            $table
                ->tinyInteger('category_id')
                ->unsigned()
                ->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asigments');
    }
}
