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
            $table
                ->enum('status', ['pending', 'accepted', 'denied'])
                ->default('pending');
            $table
                ->integer('asigment_id')
                ->unsigned()
                ->constrained();
            $table
                ->integer('teacher_id')
                ->unsigned()
                ->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
