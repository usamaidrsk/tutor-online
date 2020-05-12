<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_acepted')->default(false);
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
        Schema::dropIfExists('invitations');
    }
}
