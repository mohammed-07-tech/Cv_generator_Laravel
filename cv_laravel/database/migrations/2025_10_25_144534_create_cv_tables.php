<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ table principale
        Schema::create('cv_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('about')->nullable();
            $table->string('skills')->nullable();
            $table->string('image_path')->nullable();
            $table->string('theme')->nullable();
            $table->timestamps();
        });

        // ✅ table diplomas
        Schema::create('diplomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cv_data')->onDelete('cascade');
            $table->string('diploma');
            $table->string('institution');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        // ✅ table experiences
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cv_data')->onDelete('cascade');
            $table->string('job_title');
            $table->string('company');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // ✅ table languages
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cv_data')->onDelete('cascade');
            $table->string('language');
            $table->timestamps();
        });

        // ✅ table hobbies
        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cv_data')->onDelete('cascade');
            $table->string('hobby');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hobbies');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('diplomas');
        Schema::dropIfExists('cv_data');
    }
};
