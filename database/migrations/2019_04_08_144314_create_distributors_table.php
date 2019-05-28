<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->bigIncrements('distributor_id');
            $table->string('name');
            $table->integer('phone_one')->unique();
            $table->integer('phone_two')->unique();
            $table->string('email')->unique();
            $table->text('address');
            $table->integer('credit_limit');
            $table->string('credit_reduction_per_month');
            $table->integer('outlet_id');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributors');
    }
}
