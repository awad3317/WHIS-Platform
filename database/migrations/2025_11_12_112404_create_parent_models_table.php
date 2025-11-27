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
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('name_ar', 100);
            $table->string('name_en', 100)->nullable();
            $table->string('phone', 20)->unique();    
            $table->string('email', 100)->nullable();
            $table->string('national_id', 20)->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('job_title', 100)->nullable(); 
            $table->string('workplace', 150)->nullable(); 
            $table->string('mobile', 20)->nullable();
            $table->string('image', 255)->nullable();
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
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