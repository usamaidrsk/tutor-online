<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTeacherTable extends Migration
{
    public function up()
    {
        Schema::create('level_teacher', function (Blueprint $table) {
            $table
                ->tinyInteger('level_id')
                ->unsigned()
                ->constrained()
                ->onDelete('cascade');
            $table
                ->integer('teacher_id')
                ->unsigned()
                ->constrained()
                ->onDelete('cascade');

            $table->primary(['level_id', 'teacher_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('level_teacher');
    }
}
