<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutMoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('date');
            $table->string('sum');
            $table->string('status')->default('На проверке');
            $table->string('comment')->nullable();
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('out_moneys');
    }
}
