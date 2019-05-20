<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcmProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcm_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',191)->nullable(false)->comment('project name in the firebase.io');
            $table->string('server_key',191)->nullable(false)->comment('server key in the firebase.io');
            $table->unsignedInteger('user_id')->nullable(false)->comment('relation to users table');
            $table->timestamps();
        });
    }
    
    public function down(){
        Schema::dropIfExists('fcm_projects');
    }
}
