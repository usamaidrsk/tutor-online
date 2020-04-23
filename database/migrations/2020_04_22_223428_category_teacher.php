<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryTeacher extends Migration
{
    public function up()
    {
        Schema::create('category_teacher', function (Blueprint $table) {
            $table
                ->tinyInteger('category_id')
                ->unsigned()
                ->constrained()
                ->onDelete('cascade');
            $table
                ->integer('teacher_id')
                ->unsigned()
                ->constrained()
                ->onDelete('cascade');

            $table->primary(['category_id', 'teacher_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_teacher');
    }
}
