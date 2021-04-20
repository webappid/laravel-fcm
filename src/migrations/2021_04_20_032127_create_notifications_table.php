<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)
                ->unique();
            $table->unsignedBigInteger('user_id')
                ->comment('sender user id');
            $table->unsignedBigInteger('receiver_id')
                ->comment('receiver user id');
            $table->string('title');
            $table->text('body');
            $table->string('action')
                ->nullable(true);
            $table->timestamps();

            /**
             * relation
             */

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receiver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
