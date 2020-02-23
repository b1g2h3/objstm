<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->unsignedInteger('user_id');
            $table->string('description')->nullable();
            $table->string('status');
            $table->timestamps();
            
        });

        Schema::create('amount_order', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('amount_id')->unsigned();
            $table->integer('order_id')->unsigned();
        });

        Schema::table('amount_order', function (Blueprint $table) {
            $table->foreign('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade');
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
        Schema::dropIfExists('amount_order');
    }
}
