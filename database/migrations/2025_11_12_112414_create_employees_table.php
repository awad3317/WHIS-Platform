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
    $table->string('id', 50)->primary();
    $table->string('user_id', 50)->unique();
    $table->string('name_ar', 100);
    $table->string('name_en', 100)->nullable();
    $table->string('email', 100)->nullable();
    $table->string('national_id', 20)->unique();
    $table->string('job_title', 100); 
    $table->enum('department', ['administration', 'teaching', 'support']);
    $table->string('qualification', 100)->nullable(); 
    $table->year('graduation_year')->nullable(); 
    $table->string('phone', 20)->nullable(); 
    $table->decimal('salary', 10, 2)->nullable(); 
    $table->enum('id_type', ['national_id', 'passport', 'residence_id'])->default('national_id'); // نوع الهوية
    $table->integer('weekly_classes')->default(0);
    $table->json('subjects')->nullable(); 
    $table->boolean('is_active')->default(true);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
