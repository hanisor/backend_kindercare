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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('my_kid_number')->nullable()->unique();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('allergy')->nullable();
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
        Schema::dropIfExists('children');
    }
};
