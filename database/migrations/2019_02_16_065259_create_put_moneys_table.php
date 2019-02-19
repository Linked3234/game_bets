<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePutMoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('put_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('put_variable_id')->nullable();
            $table->string('date');
            $table->string('sum');
            $table->string('description')->nullable();
            $table->string('status')->default('На проверке');
            $table->string('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('put_moneys');
    }
}
