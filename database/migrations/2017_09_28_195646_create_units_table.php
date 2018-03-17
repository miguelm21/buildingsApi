<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('phone')->nullable();
            $table->string('floor');
            $table->string('deparment');
            $table->integer('unit');
            $table->float('percent_a', 8, 3);
            $table->float('percent_b', 8, 3)->nullable();
            $table->float('percent_c', 8, 3)->nullable();
            $table->float('debt')->nullable()->default(0);
            $table->float('previousbalance', 8, 3)->default(0);
            $table->boolean('prorateado')->nullable();
            $table->float('interests', 8, 3);
            $table->float('previousinterest', 8, 3)->nullable()->default(0);
            $table->float('privateexpense')->nullable()->default(0);
            $table->string('mail')->nullable();
            $table->string('observations')->nullable();
            $table->string('datepayment')->nullable();
            $table->float('amountpayment')->default(0);
            $table->string('observationpayment')->nullable();;
            $table->float('enterEnt')->nullable()->default(0);
            $table->float('enterExp')->nullable()->default(0);
            $table->float('enterDebt')->nullable()->default(0);
            $table->float('expA')->nullable()->default(0);
            $table->float('expB')->nullable()->default(0);
            $table->float('expC')->nullable()->default(0);
            $table->float('expTotal')->nullable()->default(0);
            $table->float('extraShare')->nullable()->default(0);
            $table->string('fechaAcreditacion')->nullable();
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
        Schema::dropIfExists('units');
    }
}
