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
        Schema::create('commissions_group_general_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comm_group_id');
            $table->unsignedBigInteger('gen_comm_id');
            $table->foreign('comm_group_id')->references('id')->on('commissions_groups');
            $table->foreign('gen_comm_id')->references('id')->on('general_commissions');
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
        Schema::dropIfExists('commissions_group_general_commissions');
    }
};
