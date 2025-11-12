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
        Schema::create('parent_models', function (Blueprint $table) {
            $table->id();
            $table->string('id', 50)->primary();
            $table->string('user_id', 50)->unique();
            $table->string('name_ar', 100);
            $table->string('name_en', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('national_id', 20)->unique();
            $table->enum('relationship', ['father', 'mother', 'guardian']);
            $table->string('job_title', 100)->nullable(); 
            $table->string('workplace', 150)->nullable(); 
            $table->string('mobile', 20)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_models');
    }
};
