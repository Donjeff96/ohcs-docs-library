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
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname',300)->nullable();
            $table->string('othernames',300)->nullable();
            $table->string('surname',300)->nullable();
            $table->string('ptitle',300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('othernames');
            $table->dropColumn('surname');
            $table->dropColumn('ptitle');
        });
    }
};
