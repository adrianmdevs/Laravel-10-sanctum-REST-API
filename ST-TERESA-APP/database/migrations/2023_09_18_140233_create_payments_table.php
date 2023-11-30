<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pupil_id'); // Foreign key for the student
            $table->unsignedBigInteger('guardian_id'); // Foreign key for the guardian
            $table->decimal('amount', 10, 2); // Amount of the payment
            $table->date('payment_date'); // Date of the payment
            $table->unsignedBigInteger('notification_id')->nullable(); // Foreign key for the notification
            $table->timestamps();
            // Defining foreign key relationships
            $table->foreign('pupil_id')->references('id')->on('pupils')->onDelete('cascade');
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('cascade');
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}
