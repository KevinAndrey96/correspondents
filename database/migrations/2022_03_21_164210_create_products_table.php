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
        Schema::create('products', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('product_name');
            $table->string('product_type');
            $table->string('product_description');
            $table->string('product_logo')->nullable();
            $table->float('product_commission')->nullable();
            $table->boolean('is_enabled')->default(1);
            $table->boolean('client_name')->default(0);
            $table->boolean('client_document')->default(0);
            $table->boolean('phone_number')->default(0);
            $table->boolean('email')->default(0);
            $table->boolean('account_type')->default(0);
            $table->boolean('account_number')->default(1);
            $table->boolean('code')->default(0);
            $table->boolean('extra')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
