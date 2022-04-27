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
        Schema::create('transactions', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->unsignedBigInteger('shopkeeper_id');
            $table->unsignedBigInteger('distributor_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('account_number')->nullable();
            $table->float('amount');
            $table->string('type');
            $table->string('status');
            $table->text('detail')->nullable();
            $table->date('date');
            $table->string('voucher')->nullable();
            $table->text('comment')->nullable();
            $table->float('com_adm')->nullable();
            $table->float('com_dis')->nullable();
            $table->float('com_sup')->nullable();
            $table->float('com_shp')->nullable();
            $table->timestamps();
            $table->foreign('shopkeeper_id')->references('id')->on('users');
            $table->foreign('distributor_id')->references('id')->on('users');
            $table->foreign('supplier_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};

