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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time')->nullable();
            $table->string('day')->nullable();
            $table->string('week')->nullable();
            $table->string('month')->nullable();
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
        Schema::dropIfExists('attendances');
    }
};
