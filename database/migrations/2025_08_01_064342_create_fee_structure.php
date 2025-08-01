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
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('fee_type_id');
            $table->unsignedBigInteger('session_id')->nullable();

            // Fee Info
            $table->decimal('amount', 10, 2);
            $table->string('frequency')->default('monthly'); // monthly, yearly, one-time
            $table->date('due_date')->nullable();

            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('fee_type_id')->references('id')->on('fee_types')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('school_sessions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
