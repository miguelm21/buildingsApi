<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('datestart');
            $table->date('datestart2');
            $table->string('dateend');
            $table->date('dateend2');
            $table->string('type');
            $table->text('description');
            $table->string('summary');
            $table->longtext('attachment')->nullable();
            $table->integer('codepayment')->nullable()->default(0);
            $table->float('noticeamountpayment')->default(0);
            $table->date('noticedatepayment')->nullable();
            $table->string('noticedescpayment')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('users_units');
    }
}
