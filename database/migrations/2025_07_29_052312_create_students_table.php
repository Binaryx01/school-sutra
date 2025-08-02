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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');

            $table->string('guardian_name');
            $table->string('contact_number');
            $table->text('address');

            // Fee-related fields
            $table->boolean('is_hostel')->default(false);
            $table->boolean('uses_transport')->default(false);

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
