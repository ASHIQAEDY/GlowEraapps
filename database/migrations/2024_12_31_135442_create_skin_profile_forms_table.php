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
        Schema::create('skin_profile_forms', function (Blueprint $table) {
            $table->id('FormID'); // Primary key
        $table->integer('Acne')->nullable(); // Nullable integer
        $table->integer('FineLine')->nullable();
        $table->integer('Darkspots')->nullable();
        $table->integer('Redness')->nullable();
        $table->integer('Dryness')->nullable();
        $table->integer('Oily')->nullable();
        $table->integer('PoresRate')->nullable();
        $table->integer('Irritation')->nullable();
        $table->integer('Firmness')->nullable();
        $table->integer('Darkcircles')->nullable();
        $table->integer('TotalScore')->nullable();
        $table->string('InterpretationStatus')->nullable();

        $table->timestamps(); // Adds created_at and updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skin_profile_forms');
    }
};
