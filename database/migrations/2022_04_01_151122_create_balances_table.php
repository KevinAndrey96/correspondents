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
        Schema::create('balances', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->float('amount')->default(0);
            $table->date('date')->nullable();
            $table->boolean('is_valid')->default(0);
            $table->string('type');
            $table->string('boucher')->nullable();
            $table->string('code')->unique()->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balances');
    }
};
