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
            $table->string('suterhcode');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('cuitnumber');
            $table->text('comment');
            $table->float('balance');
            $table->float('previousbalance')->nullable();
            $table->integer('units');
            $table->integer('premises');
            $table->integer('parkingspaces');
            $table->float('fee');
            $table->integer('rubro')->nullable();
            $table->integer('roela')->nullable();
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
