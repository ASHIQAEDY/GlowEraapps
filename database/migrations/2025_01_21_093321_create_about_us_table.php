<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->text('introduction');       // For the introduction section
            $table->text('services');           // For listing services
            $table->text('team_background');    // For team background details
            $table->text('impact');             // For describing the organization’s impact
            $table->string('contact');          // For contact information (e.g., email or phone number)
            $table->string('visual')->nullable(); // Optional: Storing image or video URLs
            $table->string('version')->nullable(); // 
            $table->timestamps();              // Timestamps for created_at and updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
