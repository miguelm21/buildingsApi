<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJudgmentDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judgment_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expedientnumber');
            $table->string('place');
            $table->string('object');
            $table->string('status');
            $table->float('amount');
            $table->integer('partnership_id')->unsigned();
            $table->foreign('partnership_id')->references('id')->on('partnerships')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('judgment_datas');
    }
}
