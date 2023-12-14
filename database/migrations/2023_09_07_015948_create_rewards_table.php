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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('reward_name');
            $table->string('reward_slug');
            $table->text('reward_desc')->nullable();
            $table->string('reward_thumbnail')->nullable();
            $table->string('reward_code');
            $table->string('reward_rendeem_code')->nullable();
            $table->integer('rendeem_amount');
            $table->integer('reward_qty');
            $table->integer('voucher_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
