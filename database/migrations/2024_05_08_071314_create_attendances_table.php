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
            $table->dateTime('date_time_arrive')->nullable();
            $table->dateTime('date_time_leave')->nullable();
            $table->string('month')->nullable();
            $table->unsignedBigInteger('child_group_id');
            

            $table->foreign('child_group_id')
                    ->references('id')
                    ->on('child_groups');  
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
