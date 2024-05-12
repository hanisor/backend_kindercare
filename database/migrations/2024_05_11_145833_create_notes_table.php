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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->longText('detail')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->string('status')->nullable();
            $table->string('sender_type')->nullable();
            $table->unsignedBigInteger('guardian_id');
            $table->unsignedBigInteger('caregiver_id');


            $table->foreign('guardian_id')
                    ->references('id')
                    ->on('guardians');

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
        Schema::dropIfExists('notes');
    }
};
