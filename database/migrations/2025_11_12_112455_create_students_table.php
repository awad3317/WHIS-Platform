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
        Schema::create('students', callback: function (Blueprint $table) {
            $table->id();
            $table->string('academic_no', 50)->unique();
            $table->string('name_ar', 100);
            $table->string('name_en', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('national_id', 20)->nullable();
            $table->enum('national_id_type', ['national_id', 'passport', 'residence_id'])->default('national_id'); // نوع الهوية
            $table->integer('weekly_classes')->default(0);
            $table->string('nationality', 100);
            $table->string('previous_school', 200)->nullable();
            $table->string('transfer_reason', 300)->nullable(); 
            $table->date('enrollment_date');
            $table->string('folder_name', 100)->nullable();
            $table->softDeletes();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
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