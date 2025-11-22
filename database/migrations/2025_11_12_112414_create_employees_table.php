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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name_ar', 100);
            $table->string('name_en', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('national_id', 20)->unique();
            $table->string('job_title', 100);
            $table->enum('department', ['admin', 'teaching', 'support']);
            $table->string('qualification', 100)->nullable();
            $table->year('graduation_year')->nullable();
            $table->string('phone', 20)->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('national_id_type', ['national_id', 'passport', 'residence_id'])->default('national_id');
            $table->integer('weekly_classes')->default(0);
            $table->json('subjects')->nullable();
            $table->string('image', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes(); 
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};