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
        Schema::create('personnel_mains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number');
            $table->integer('file_number');
            $table->string('name',300);
            $table->integer('rank');
            $table->integer('institution');
            $table->string('grader');
            $table->string('date_of_hire');
            $table->string('date_of_retirement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_mains');
    }
};
