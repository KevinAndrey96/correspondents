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
            $table->unsignedBigInteger('product_id');
            $table->string('account_number')->nullable();
            $table->float('amount');
            $table->string('type');
            $table->string('status');
            $table->date('date');
            $table->text('detail')->nullable();
            $table->string('boucher')->nullable();
            $table->text('comment')->nullable();
            $table->float('com_adm')->nullable();
            $table->float('com_dis')->nullable();
            $table->float('com_sup')->nullable();
            $table->float('com_shp')->nullable();
            $table->string('receipt')->nullable();
            $table->timestamps();
            $table->foreign('shopkeeper_id')->references('id')->on('users');
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
