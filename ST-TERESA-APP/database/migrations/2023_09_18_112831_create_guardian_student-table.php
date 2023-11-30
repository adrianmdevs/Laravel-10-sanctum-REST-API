<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianStudentTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void

    {
        Schema::create('guardian_student', function (Blueprint $table) {
            $table->id(); // Optional, but recommended for consistency
            $table->unsignedBigInteger('guardian_id');
            $table->unsignedBigInteger('pupil_id');
            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('cascade');
            $table->foreign('pupil_id')->references('id')->on('pupils')->onDelete('cascade');

            // Add a unique constraint to prevent duplicate associations
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardian_student');
    }
}
