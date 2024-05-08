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
        Schema::create('child_relatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->unsignedBigInteger('relative_id')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('child_id')
                    ->references('id')
                    ->on('children');

            $table->foreign('relative_id')
                    ->references('id')
                    ->on('relatives');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_relatives');
    }
};
