<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); // Foreign key for the teacher
            $table->unsignedBigInteger('subject_id'); // Foreign key for the subject
            $table->unsignedBigInteger('grade_id'); // Foreign key for the grade
            $table->string('day_of_week'); // Day of the week for the class
            $table->time('start_time'); // Start time of the class
            $table->time('end_time'); // End time of the class
            $table->timestamps();

            //Defining the foreign key relationships;
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
}
