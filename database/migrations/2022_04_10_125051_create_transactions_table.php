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
            $table->bigInteger('shopkeeper_id')->unsigned();
            $table->bigInteger('distributor_id')->unsigned();
            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('product_id')->nullable();
            $table->string('client_name');
            $table->string('client_document');
            $table->string('phone_number')->nullable();
            $table->string('account_number')->nullable();
            $table->float('transaction_amount')->default(0);
            $table->date('transaction_date');
            $table->string('transaction_type');
            $table->string('transaction_state');
            $table->text('product_requirements')->nullable();
            $table->string('transaction_receipt')->nullable();
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
