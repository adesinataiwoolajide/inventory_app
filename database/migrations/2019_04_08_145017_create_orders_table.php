<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_slug');
            $table->string('transaction_id')->unique();;
            $table->string('order_date');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('total_price');
            $table->integer('total_order');
            $table->string('customer_name');
            $table->string('payment_method');
            $table->integer('outlet_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('orders');
    }
}
