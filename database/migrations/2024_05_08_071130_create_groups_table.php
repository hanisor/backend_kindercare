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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('time')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('caregiver_id')->nullable();

            // Define foreign key constraints
            $table->foreign('session_id')
                    ->references('id')
                    ->on('kinder_sessions');

            $table->foreign('caregiver_id')
                    ->references('id')
                    ->on('caregivers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
