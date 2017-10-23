<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_salary_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detail');
            $table->float('amount');
            $table->integer('manager_id')->unsigned();
            $table->foreign('manager_id')->references('id')->on('managers');
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
        Schema::dropIfExists('manager_salary_details');
    }
}
