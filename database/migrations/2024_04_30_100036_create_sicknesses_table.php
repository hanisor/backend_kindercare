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
        Schema::create('sicknesses', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('dosage')->nullable();
            $table->datetime('date_time')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('child_id');

            $table->foreign('child_id')
                    ->references('id')
                    ->on('children');        
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sicknesses');
    }
};
