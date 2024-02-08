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
        Schema::create('ninja_districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ninja_regency_id')->nullable();
            $table->string('name')->nullable();
            $table->string('l1_tier_code')->nullable();
            $table->string('l2_tier_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ninja_districts');
    }
};
