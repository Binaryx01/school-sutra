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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('gender');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->string('qualification')->nullable();
        $table->text('address')->nullable();
        $table->date('joined_date')->nullable();
        $table->unsignedBigInteger('session_id'); // active session
        $table->timestamps();

        $table->foreign('session_id')->references('id')->on('school_sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
