<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_fields', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_description')->nullable();
            $table->string('product_logo')->nullable();
            $table->string('product_commission')->nullable();
            $table->string('com_dis')->nullable();
            $table->string('com_shp')->nullable();
            $table->string('com_sup')->nullable();
            $table->string('fixed_commission')->nullable();
            $table->string('is_enabled')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_document')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('account_type')->nullable();
            $table->string('account_number')->nullable();
            $table->string('code')->nullable();
            $table->string('reassignment_minutes')->nullable();
            $table->string('extra')->nullable();
            $table->string('min_amount')->nullable();
            $table->string('max_amount')->nullable();
            $table->string('priority')->nullable();
            $table->string('num_jineteo')->nullable();
            $table->string('hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_fields');
    }
};
