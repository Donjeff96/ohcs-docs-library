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
        Schema::create('user_links', function (Blueprint $table) {
            $table->increments('id');
            $table->char('link_url',200);
            $table->char('link_name',200);
            $table->char('link_target',200)->nullable();
            $table->char('link_image',200);
            $table->integer('link_parent');
            $table->char('page_id',200);
            $table->char('page_id_sub',200)->nullable();
            $table->char('status',200)->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_links');
    }
};
