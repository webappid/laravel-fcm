<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcmSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcm_subscribes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fcm_project_id')->nullable(false)->comment('relation to fcm projects table');
            $table->string('token')->nullable(false)->index()->comment('fcm token');
            $table->enum('active', ['yes', 'no'])->default('yes')->nullable(false)->comment('activate');
            $table->string('agent', 191);
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('relation to users table');
            $table->unsignedBigInteger('creator_id')->nullable(false)->comment('relation to users table');
            $table->unsignedBigInteger('owner_id')->nullable(false)->comment('relation to users table as owner data');
            $table->timestamps();
            
            $table->index(["fcm_project_id", "token"]);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('fcm_project_id')->references('id')->on('fcm_projects');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fcm_subscribes');
    }
}
