<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('client_code')->unique()->nullable();
            $table->string('password');
            $table->foreignId('direction_id')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->text('avatar')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('employer')->default(0);
            $table->double('balance')->default(0.0);
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
        Schema::dropIfExists('users');
    }
}
