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
        Schema::create('relatives', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('relation')->nullable();
            $table->string('phone_number')->nullable();
            $table->datetime('date_time')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('guardian_id');

            $table->foreign('guardian_id')
                    ->references('id')
                    ->on('guardians');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatives');
    }
};
