<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('concept')->nullable();
            $table->string('dues')->nullable();
            $table->string('duestotal')->nullable();
            $table->string('date');
            $table->float('amount_a')->default(0);
            $table->float('amount_b')->default(0);
            $table->float('amount_c')->default(0);
            $table->float('rubro');
            $table->float('repeat');
            $table->string('factnumber')->nullable();
            $table->integer('provider_id')->nullable()->default(0);
            $table->integer('unit_id')->nullable()->default(0);
            $table->integer('partnership_id')->unsigned();
            $table->boolean('hidden')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
