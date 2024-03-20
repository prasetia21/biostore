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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('ninja_province_id');
            $table->unsignedBigInteger('ninja_regency_id');
            $table->unsignedBigInteger('ninja_district_id');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('note')->nullable();
            $table->boolean('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
