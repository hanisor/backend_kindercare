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
        Schema::create('caregivers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('ic_number')->nullable()->unique();
            $table->string('phone_number')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('username')->nullable(); 	
            $table->string('password')->nullable();
            $table->binary('image')->nullable(); // Make the 'image' field nullable
            $table->string('role')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caregivers');
    }
};
