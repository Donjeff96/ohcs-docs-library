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
        Schema::create('job_qualification_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('highest_academic_id')->nullable();
            $table->string('profeesional_qualification',300)->nullable();
            $table->string('highest_academic_doc_id',300)->nullable();
            $table->string('profeesional_qualification_doc_id',300)->nullable();
            $table->string('cadre',300)->nullable();
            $table->string('category',300)->nullable();
            $table->integer('number_of_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_qualification_information');
    }
};
