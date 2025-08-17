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
        Schema::create('document_libraries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('document_type_id');
            $table->longText('document_path');
            $table->integer('document_classification_id');
            $table->longText('description')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_libraries');
    }
};
