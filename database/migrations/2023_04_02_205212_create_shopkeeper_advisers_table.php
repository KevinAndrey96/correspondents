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
        Schema::create('shopkeeper_advisers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shopkeeper_id')->unique();
            $table->unsignedBigInteger('adviser_id');
            $table->foreign('shopkeeper_id')->references('id')->on('users');
            $table->foreign('adviser_id')->references('id')->on('users');
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
        Schema::dropIfExists('shopkeeper_advisers');
    }
};
