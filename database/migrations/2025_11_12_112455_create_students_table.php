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
        Schema::create('students', function (Blueprint $table) {
            $table->string('academic_no', 50)->primary();
            $table->string('name_ar', 100);
            $table->string('name_en', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('national_id', 20)->nullable();
            $table->date('enrollment_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('parent_id')->references('id')->on('parents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};