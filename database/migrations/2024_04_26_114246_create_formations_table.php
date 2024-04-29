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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('formation_name');
            $table->enum('formation_type', ['jour', 'soir', 'weekend'])->default('jour');
            $table->enum('class_format', ['prensentiel', 'online'])->default('prensentiel');
            $table->string('accreditation')->nullable();
            $table->integer('formation_duration');
            $table->string('study_level_required');
            $table->integer('registration_payment');
            $table->integer('monthly_payment');

            $table->foreignId('school_id')
                ->constrained('schools')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreignId('formation_grade_id')
                ->constrained('formation_grades')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreignId('sub_domain_id')
                ->constrained('sub_domains')
                ->onDelete('no action')
                ->onUpdate('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
