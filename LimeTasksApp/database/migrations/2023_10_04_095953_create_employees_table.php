<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->unique();
            $table->string('employee_name');
            $table->enum("job_title", ['Technician','Developer', 'Call center', 'Mechanic']);
            $table->string("organization")->default("Lime Emerging Solutions");
            $table->string("phone_number")->nullable();
            $table->text("details")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
