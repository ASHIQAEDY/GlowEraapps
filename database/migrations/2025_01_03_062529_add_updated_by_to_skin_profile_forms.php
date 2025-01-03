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
        Schema::table('skin_profile_forms', function (Blueprint $table) {
            // Add the 'updated_by' column, assuming it's a foreign key referencing the 'users' table
            $table->unsignedBigInteger('updated_by')->nullable();

            // Optionally add a foreign key constraint if you want to link it to the users table
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skin_profile_forms', function (Blueprint $table) {
            // Drop the 'updated_by' column and foreign key constraint
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
        });
    }
};
