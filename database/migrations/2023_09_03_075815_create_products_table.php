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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('product_name');
            $table->string('product_slug')->unique();
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_dimension_x')->nullable();
            $table->string('product_dimension_y')->nullable();
            $table->string('product_dimension_z')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->text('short_desc');
            $table->text('long_desc');
            $table->string('product_thumbnail');
            $table->integer('featured')->nullable();
            $table->integer('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
