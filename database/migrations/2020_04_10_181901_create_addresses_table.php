<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('line', 100)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table
                ->tinyInteger('country_id')
                ->unsigned()
                ->constrained()
                ->nullable();
            $table
                ->integer('teacher_id')
                ->unsigned()
                ->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
