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
            $table->string('line', 100);
            $table->string('state', 50);
            $table->string('city', 50);
            $table->string('zip_code', 10);
            $table
                ->tinyInteger('country_id')
                ->unsigned()
                ->constrained();
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
