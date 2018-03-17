<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnerships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('number');
            $table->integer('suterhcode');
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('cuitnumber');
            $table->text('comment')->nullable();
            $table->float('balance');
            $table->float('previousbalance')->nullable();
            $table->string('lastprorateado')->nullable();
            $table->integer('units');
            $table->integer('premises');
            $table->integer('parkingspaces');
            $table->float('fee');
            $table->string('period')->nullable();
            $table->integer('roela')->nullable()->nullable();
            $table->float('expense_a')->nullable()->default(0);
            $table->float('expense_b')->nullable()->default(0);
            $table->float('expense_c')->nullable()->default(0);
            $table->float('extraamount')->nullable()->default(0);
            $table->string('extratype')->nullable();
            $table->string('expiration')->nullable();
            $table->string('deadline')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('partnerships');
    }
}
