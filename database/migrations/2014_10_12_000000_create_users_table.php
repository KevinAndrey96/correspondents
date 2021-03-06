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
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');
            $table->string('phone');
            $table->double('balance')->nullable()->default(0);
            $table->double('profit')->nullable()->default(0);
            $table->integer('max_queue')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document')->nullable();
            $table->string('city');
            $table->string('address')->nullable();
            $table->integer('priority')->nullable();
            $table->boolean('is_online')->nullable();
            $table->boolean('is_enabled');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('google2fa_secret')->default('eyJpdiI6InN3eWhrU3o4TnhFblcvOEpPUkJ5ZUE9PSIsInZhbHVlIjoidlRwVi9nZXFlSzRSRFRJekh6RTJYclJHOEE0OHc1N3AzRmRPb2dLUFdUUT0iLCJtYWMiOiJmYzY0NTQ2OTE5OWU1NjhiNGFiYWZkM2EwNzFkNTMyMTgzMTljMGI5ZDExOWEzMmRhOGE0MmVkZmE1ZGRmZmUzIiwidGFnIjoiIn0');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('distributor_id')->nullable();
            $table->foreign('distributor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
