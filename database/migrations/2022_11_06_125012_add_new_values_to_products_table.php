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
        Schema::table('products', function (Blueprint $table) {
            $table->double('min_amount');
            $table->double('max_amount');
            $table->integer('priority');
            $table->integer('num_jineteo');
            $table->integer('hours');
            $table->longText('product_description')->change();

            /*
            $table->dropColumn('min_amount');
            $table->dropColumn('max_amount');
            $table->dropColumn('priority');
            $table->dropColumn('description');
            $table->dropColumn('num_jineteo');
            $table->dropColumn('hours');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
