<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcmLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcm_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fcm_subscribe_id')
                ->comment('relation to fcm_subscribes table');
            $table->string('request');
            $table->string('response')
                ->nullable(true);
            $table->unsignedBigInteger('user_id')
                ->comment('relation to users table');
            $table->timestamps();
            /**
             * relation
             */
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fcm_subscribe_id')->references('id')->on('fcm_subscribes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fcm_logs');
    }
}
