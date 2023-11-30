<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pupil_id'); // Foreign key for the student
            $table->unsignedBigInteger('exam_id'); // Foreign key for the exam
            $table->unsignedBigInteger('subject_id'); // Foreign key for the subject
            $table->integer('score'); // Scores as integers
            $table->timestamps();

            //Defining the foreign keys in the relationships
            $table->foreign('pupil_id')->references('id')->on('pupils')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
