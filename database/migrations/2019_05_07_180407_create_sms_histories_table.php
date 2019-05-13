<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number');
            $table->string('sms_text');
            $table->integer('send_status');
            $table->string('send_message');
            $table->string('send_desc');
            $table->string('phone_sender');
            $table->integer('client_id')->unsigned()->index()->nullable();
            $table->string('provider');
            $table->string('tag1');
            $table->string('tag2');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sms_histories');
    }
}
