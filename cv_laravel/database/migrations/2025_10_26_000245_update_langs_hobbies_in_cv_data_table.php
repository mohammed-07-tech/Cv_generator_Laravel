<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cv_data', function (Blueprint $table) {
            $table->text('langs')->nullable()->change();
            $table->text('hobbies')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('cv_data', function (Blueprint $table) {
            $table->string('langs', 255)->nullable()->change();
            $table->string('hobbies', 255)->nullable()->change();
        });
    }

};
