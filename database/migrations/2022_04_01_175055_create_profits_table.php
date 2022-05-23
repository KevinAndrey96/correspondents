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
        Schema::create('profits', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->float('amount')->default(0);
            $table->date('date')->nullable();
            $table->boolean('is_valid')->default(0);
            $table->string('type');
            $table->string('boucher')->nullable();
            $table->string('extra')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("set null");
            $table->foreign('transaction_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profits');
    }
};
