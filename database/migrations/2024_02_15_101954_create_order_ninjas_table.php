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
        Schema::create('order_ninjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->unsignedBigInteger('ninja_province_id');
            $table->unsignedBigInteger('ninja_regency_id');
            $table->unsignedBigInteger('ninja_district_id');
            $table->string('payment_type')->nullable();
            $table->string('service_type')->nullable();
            $table->string('service_level')->nullable();
            $table->string('requested_tracking_number');
            $table->string('merchant_order_number')->nullable();
            $table->string('origin_name')->nullable();
            $table->string('origin_email')->nullable();
            $table->string('origin_phone')->nullable();
            $table->string('shipping_origin1')->nullable();
            $table->string('shipping_origin2')->nullable();
            $table->string('kecamatan_origin')->nullable();
            $table->string('city_origin')->nullable();
            $table->string('province_origin')->nullable();
            $table->string('address_type_origin')->nullable();
            $table->string('country_origin')->nullable();
            $table->string('post_code_origin')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_address1')->nullable();
            $table->string('shipping_address2')->nullable();
            $table->string('kecamatan_destination')->nullable();
            $table->string('city_destination')->nullable();
            $table->string('province_destination')->nullable();
            $table->string('address_type_destination')->nullable();
            $table->string('country_destination')->nullable();
            $table->string('post_code_destination')->nullable();
            $table->text('notes')->nullable();
            $table->integer('weight');
            $table->string('currency');
            $table->float('shipping_price',8,2);
            $table->float('cash_on_delivery',8,2);
            $table->float('amount',8,2);
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->string('confirmed_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('pickup_date')->nullable();
            $table->string('pickup_start_time')->nullable();
            $table->string('pickup_end_time')->nullable();
            $table->string('delivery_start_date')->nullable();
            $table->string('deliver_start_time')->nullable();
            $table->string('deliver_end_time')->nullable();
            $table->text('delivery_instructions')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('return_order')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->string('comments')->nullable(); 
            $table->string('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_ninjas');
    }
};
