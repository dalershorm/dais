<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportDailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_dailies', function (Blueprint $table) {
            $table->id();
            $table->string('cost');
            $table->string('weight');
            $table->integer('total');
            $table->foreignId('status_id');
            $table->dateTime('report_date');
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
        Schema::dropIfExists('report_dailies');
    }
}
