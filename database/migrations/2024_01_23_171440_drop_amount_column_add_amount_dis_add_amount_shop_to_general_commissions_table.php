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
        Schema::table('general_commissions', function (Blueprint $table) {
            $table->dropColumn('amount');
            $table->float('amount_dis')->nullable();
            $table->float('amount_shop')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_commissions', function (Blueprint $table) {
            //
        });
    }
};
