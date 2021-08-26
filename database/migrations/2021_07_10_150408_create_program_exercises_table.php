<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exerciseId')->constrained('exercises')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('programeId')->constrained('programes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('counters');
            $table->integer('day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_exercises');
    }
}
