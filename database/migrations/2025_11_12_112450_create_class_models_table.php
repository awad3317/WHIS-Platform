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
        Schema::create('class_models', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 50);
            $table->string('name_en', 50)->nullable();
            $table->enum('grade_level', ['1', '2', '3', '4', '5', '6']);
            $table->string('section', 10)->nullable();
            $table->integer('capacity')->default(30);
            $table->string('academic_year');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_models');
    }
};
