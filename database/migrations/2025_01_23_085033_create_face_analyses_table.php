<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaceAnalysesTable extends Migration
{
    public function up()
    {
        Schema::create('face_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('analysis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('face_analyses');
    }
}