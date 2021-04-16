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
            $table->increments('id');
            $table->unsignedInteger('owner_id')->nullable(false)->comment('relation to users table as owner data');
            $table->unsignedInteger('fcm_project_id')->nullable(false)->comment('relation to fcm projects table');
            $table->enum('active', ['yes', 'no'])->default('yes')->nullable(false)->comment('activate');
            $table->string('agent',191);
            $table->unsignedInteger('user_id')->nullable(false)->comment('relation to users table');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('owner_id')->references('id')->on('users');
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