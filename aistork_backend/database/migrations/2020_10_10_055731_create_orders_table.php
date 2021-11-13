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
            $table->id();
            $table->string('track_code');
            $table->float('weight');
            $table->string('comment')->nullable();
            $table->float('cost');
            $table->float('cost_china')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('employer_id');
            $table->foreignId('shipping_id');
            $table->foreignId('direction_id');
            $table->integer('boxes');
            $table->foreignId('status_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
